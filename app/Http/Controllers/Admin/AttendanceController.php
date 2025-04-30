<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\AttendanceRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AttendanceController extends Controller
{
    /**
     * Display the attendance list
     */
    public function index()
    {
        $students = User::with(['attendanceRecord', 'studentDetail'])
            ->active()
            ->paginate(15);

        return view('admin.attendance.index', compact('students'));
    }

    /**
     * Show import form
     */
    public function showImport()
    {
        return view('admin.attendance.import');
    }

    /**
     * Download import template
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = [
            'NO', 'ID', 'NAME', 
            'HADIR REG', 'HADIR BHS', 'HADIR CSS', 'HADIR CGG',
            'JOURNAL ENTRY', 'PERMISSION',
            'SPR FATHER', 'SPR MOTHER', 'SPR SIBLING'
        ];

        // Set column headers
        foreach (range(0, count($headers) - 1) as $i) {
            $column = chr(65 + $i);
            $sheet->setCellValue($column . '1', $headers[$i]);
            $sheet->getColumnDimension($column)->setWidth(15);
        }

        // Get all active students
        $students = User::with('studentDetail')
            ->active()
            ->get();

        // Add student data
        foreach ($students as $index => $student) {
            $rowIndex = $index + 2; // Start from row 2
            
            // Set student data
            $sheet->setCellValue('A' . $rowIndex, $index + 1);    // NO
            $sheet->setCellValue('B' . $rowIndex, $student->id);   // ID
            $sheet->setCellValue('C' . $rowIndex, $student->nama); // NAME
            
            // Set empty cells for attendance data with validation
            for ($col = 3; $col <= 11; $col++) {
                $column = chr(65 + $col);
                $sheet->setCellValue($column . $rowIndex, '0');
                
                // Add data validation for numeric values
                $validation = $sheet->getCell($column . $rowIndex)->getDataValidation();
                $validation->setType(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::TYPE_WHOLE);
                $validation->setErrorStyle(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::STYLE_STOP);
                $validation->setAllowBlank(false);
                $validation->setShowInputMessage(true);
                $validation->setShowErrorMessage(true);
                $validation->setErrorTitle('Invalid Input');
                $validation->setError('Please enter a number');
                $validation->setPromptTitle('Input');
                $validation->setPrompt('Enter a number');
                $validation->setFormula1(0);
                $validation->setOperator(\PhpOffice\PhpSpreadsheet\Cell\DataValidation::OPERATOR_GREATERTHANOREQUAL);
            }

            // Style student data cells with light gray background
            $sheet->getStyle('A' . $rowIndex . ':C' . $rowIndex)->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => 'F3F4F6'],
                ],
            ]);
        }

        // Style the header row
        $sheet->getStyle('A1:L1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '4B5563'],
            ],
        ]);

        // Add notes
        $lastRow = count($students) + 4;
        $sheet->setCellValue('A' . $lastRow, 'Notes:');
        $sheet->setCellValue('A' . ($lastRow + 1), '1. All attendance columns must contain numeric values (0 or greater)');
        $sheet->setCellValue('A' . ($lastRow + 2), '2. Do not modify ID and Name columns');
        $sheet->setCellValue('A' . ($lastRow + 3), '3. Use 0 for no attendance/entry');

        // Create the file
        $writer = new Xlsx($spreadsheet);
        $filename = 'attendance_import_template.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    /**
     * Import attendance data
     */
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        try {
            DB::beginTransaction();

            $rows = Excel::toArray([], $request->file('file'))[0];
            $headers = array_shift($rows); // Remove header row
            
            $errors = [];
            $imported = 0;

            foreach ($rows as $index => $row) {
                try {
                    if (empty($row[1])) {
                        continue; // Skip empty rows
                    }

                    // Find user by ID, skip if not found
                    $user = User::find($row[1]);
                    if (!$user) {
                        throw new \Exception("Student with ID '{$row[1]}' not found.");
                    }

                    // Validate numeric values
                    foreach ([3, 4, 5, 6, 7, 8, 9, 10, 11] as $index) {
                        if (!is_numeric($row[$index])) {
                            throw new \Exception("Column " . ($index + 1) . " must be a numeric value.");
                        }
                    }

                    $attendance = $user->attendanceRecord ?? new AttendanceRecord(['user_id' => $user->id]);
                    $attendance->fill([
                        'regular_attendance' => (int)$row[3],
                        'css_attendance' => (int)$row[4],
                        'cgg_attendance' => (int)$row[5],
                        'journal_entry' => (int)$row[7],
                        'permission' => (int)$row[8],
                        'spr_father' => (int)$row[9],
                        'spr_mother' => (int)$row[10],
                        'spr_sibling' => (int)$row[11]
                    ]);

                    $attendance->save();
                    $imported++;
                } catch (\Exception $e) {
                    $errors[] = "Row " . ($index + 2) . ": " . $e->getMessage();
                }
            }

            if (count($errors) > 0) {
                DB::rollBack();
                return back()
                    ->with('error', 'Import failed. Please check the errors below.')
                    ->with('import_errors', $errors);
            }

            DB::commit();
            return back()->with('success', $imported . ' records imported successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }

    /**
     * Display regular attendance list
     */
    public function regular()
    {
        $students = User::with(['attendanceRecord', 'studentDetail'])
            ->active()
            ->paginate(15);

        return view('admin.attendance.regular', compact('students'));
    }

    /**
     * Display CSS attendance list
     */
    public function css()
    {
        $students = User::with(['attendanceRecord', 'studentDetail'])
            ->active()
            ->paginate(15);

        return view('admin.attendance.css', compact('students'));
    }

    /**
     * Display CGG attendance list
     */
    public function cgg()
    {
        $students = User::with(['attendanceRecord', 'studentDetail'])
            ->active()
            ->paginate(15);

        return view('admin.attendance.cgg', compact('students'));
    }

    /**
     * Update attendance record
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'regular_attendance' => 'nullable|integer|min:0',
            'css_attendance' => 'nullable|integer|min:0',
            'cgg_attendance' => 'nullable|integer|min:0',
            'total_sessions' => 'required|integer|min:0',
            'excused_absences' => 'nullable|integer|min:0',
            'journal_entry' => 'integer|min:0',
            'permission' => 'integer|min:0',
            'spr_father' => 'integer|min:0',
            'spr_mother' => 'integer|min:0',
            'spr_sibling' => 'integer|min:0'
        ]);

        $attendance = $user->attendanceRecord ?? new AttendanceRecord(['user_id' => $user->id]);
        $attendance->fill($validated);
        $attendance->save();

        return redirect()->back()->with('success', 'Data kehadiran berhasil diperbarui');
    }
}
