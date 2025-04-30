<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\StudentDetail;
use App\Models\FamilyMember;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class StudentBulkImportController extends Controller
{
    /**
     * Show the bulk import form
     */
    public function index()
    {
        return view('admin.users.bulk-import');
    }

    /**
     * Download the import template
     */
    public function downloadTemplate()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = [
            // User Information
            'Nama*', 'NIP*', 'Username*', 'Gender*', 'Batch ID*', 'Class ID*',
            
            // Student Details
            'Sekolah*', 'SPP*', 'No Rekening*', 'Nama Bank*', 'Cabang Bank*', 
            'Pemilik Rekening*', 'Tingkat Kelas*', 'Tahun Ajaran*',
            
            // Father's Information
            'Nama Ayah*',
            
            // Mother's Information
            'Nama Ibu*',
            
            // Sibling Information (Optional)
            'Nama Saudara 1', 'Nama Saudara 2', 'Nama Saudara 3'
        ];

        // Set column headers
        foreach (range(0, count($headers) - 1) as $i) {
            $column = chr(65 + $i); // Convert number to letter (A, B, C, etc.)
            $sheet->setCellValue($column . '1', $headers[$i]);
            
            // Set column width
            $sheet->getColumnDimension($column)->setWidth(20);
        }

        // Add sample data
        $sampleData = [
            'John Doe', '12345', 'johndoe', 'Male', '1', '1',
            'SMA Negeri 1', '500000', '1234567890', 'BCA', 'Jakarta',
            'John Doe', '11', '2023/2024',
            'James Doe', 'Jane Doe',
            'Sarah Doe', 'Mike Doe', ''
        ];

        foreach (range(0, count($sampleData) - 1) as $i) {
            $column = chr(65 + $i);
            $sheet->setCellValue($column . '2', $sampleData[$i]);
        }

        // Add notes
        $sheet->setCellValue('A4', 'Notes:');
        $sheet->setCellValue('A5', '1. Fields marked with * are mandatory');
        $sheet->setCellValue('A6', '2. Gender should be either "Male" or "Female"');
        $sheet->setCellValue('A7', '3. Batch ID and Class ID should be valid IDs from the system');
        $sheet->setCellValue('A8', '4. SPP should be in numeric format without currency symbol');
        $sheet->setCellValue('A9', '5. Username must be unique');

        // Create the file
        $writer = new Xlsx($spreadsheet);
        $filename = 'student_import_template.xlsx';
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }

    /**
     * Process the uploaded file
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
                    // Check for existing user
                    if (User::where('nip', $row[1])->orWhere('username', $row[2])->exists()) {
                        throw new \Exception("User with NIP '{$row[1]}' or username '{$row[2]}' already exists.");
                    }

                    // Validate required fields
                    if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || 
                        empty($row[4]) || empty($row[5])) {
                        throw new \Exception("Required user fields are missing.");
                    }

                    // Validate gender
                    if (!in_array(strtolower($row[3]), ['male', 'female'])) {
                        throw new \Exception("Invalid gender value. Must be 'Male' or 'Female'.");
                    }

                    // Create User
                    try {
                        $user = new User([
                            'nama' => $row[0],
                            'nip' => $row[1],
                            'username' => $row[2],
                            'password' => Hash::make(Str::random(8)), // Generate random password
                            'gender' => ucfirst(strtolower($row[3])), // Normalize gender
                            'batch_id' => $row[4],
                            'class_id' => $row[5]
                        ]);
                        $user->save();
                    } catch (\Exception $e) {
                        throw new \Exception("Failed to create user: " . $e->getMessage());
                    }

                    // Validate and create StudentDetail
                    if (empty($row[6]) || empty($row[7]) || empty($row[8])) {
                        throw new \Exception("Required student detail fields are missing.");
                    }

                    try {
                        $studentDetail = new StudentDetail([
                            'user_id' => $user->id,
                            'sekolah' => $row[6],
                            'spp' => $row[7],
                            'no_rekening' => $row[8],
                            'nama_bank' => $row[9] ?? '',
                            'cabang_bank' => $row[10] ?? '',
                            'pemilik_rekening' => $row[11] ?? '',
                            'tingkat_kelas' => $row[12] ?? '',
                            'tahun_ajaran' => $row[13] ?? '',
                            'is_active' => true
                        ]);
                        $studentDetail->save();
                    } catch (\Exception $e) {
                        throw new \Exception("Failed to create student details: " . $e->getMessage());
                    }

                    // Create Father
                    if (!empty($row[14])) {
                        FamilyMember::create([
                            'user_id' => $user->id,
                            'member_type' => 'Father',
                            'nama' => $row[14]
                        ]);
                    }

                    // Create Mother
                    if (!empty($row[15])) {
                        FamilyMember::create([
                            'user_id' => $user->id,
                            'member_type' => 'Mother',
                            'nama' => $row[15]
                        ]);
                    }

                    // Create Siblings
                    for ($i = 16; $i <= 18; $i++) {
                        if (!empty($row[$i])) {
                            FamilyMember::create([
                                'user_id' => $user->id,
                                'member_type' => 'Sibling',
                                'nama' => $row[$i]
                            ]);
                        }
                    }

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
            return back()->with('success', $imported . ' students imported successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Import failed: ' . $e->getMessage());
        }
    }
}
