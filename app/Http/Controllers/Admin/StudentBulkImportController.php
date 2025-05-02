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
     * Get column letter for Excel
     */
    private function getColumnLetter($index)
    {
        $letter = '';
        while ($index >= 0) {
            $letter = chr(65 + ($index % 26)) . $letter;
            $index = floor($index / 26) - 1;
        }
        return $letter;
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
            'Nama*', 'NIP*', 'Username*', 'Email*', 'Gender*',
            // Student Details
            'Address', 'Phone', 'Birth Date', 'Birth Place',
            'Sekolah', 'SPP', 'No Rekening', 'Nama Bank', 
            'Cabang Bank', 'Pemilik Rekening', 'Tingkat Kelas', 
            'Tahun Ajaran', 'Nominal SPP Default',
            
            // Father's Information
            'Nama Ayah', 'Pekerjaan Ayah', 'No HP Ayah', 'Alamat Ayah',
            
            // Mother's Information
            'Nama Ibu', 'Pekerjaan Ibu', 'No HP Ibu', 'Alamat Ibu',
            
            // Sibling Information
            'Nama Saudara', 'Pekerjaan Saudara', 'No HP Saudara', 'Alamat Saudara'
        ];

        // Set column headers and widths
        foreach ($headers as $index => $header) {
            $column = $this->getColumnLetter($index);
            $sheet->setCellValue($column . '1', $header);
            $sheet->getColumnDimension($column)->setWidth(20);
        }

        // Add sample data
        $sampleData = [
            'John Doe', '12345', 'johndoe', 'johndoe@example.com', 'male',
            'Jl. Sample', '08123456789', '2000-01-01', 'Jakarta',
            'SMA Negeri 1', '500000', '1234567890', 'BCA',
            'Jakarta', 'John Doe', '11', '2023/2024', '500000',
            'James Doe', 'Wiraswasta', '08111222333', 'Jl. Father',
            'Jane Doe', 'Ibu Rumah Tangga', '08444555666', 'Jl. Mother',
            'Sarah Doe', 'Pelajar', '08777888999', 'Jl. Sibling'
        ];

        // Set sample data
        foreach ($sampleData as $index => $value) {
            $column = $this->getColumnLetter($index);
            $sheet->setCellValue($column . '2', $value);
        }

        // Style the header row
        $lastColumn = $this->getColumnLetter(count($headers) - 1);
        $sheet->getStyle('A1:' . $lastColumn . '1')->applyFromArray([
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
        $sheet->setCellValue('A4', 'Notes:');
        $sheet->setCellValue('A5', '1. Fields marked with * are mandatory');
        $sheet->setCellValue('A6', '2. Gender should be either "male" or "female"');
        $sheet->setCellValue('A7', '3. Birth Date should be in YYYY-MM-DD format');
        $sheet->setCellValue('A8', '4. SPP and Nominal SPP Default should be numeric');
        $sheet->setCellValue('A9', '5. Username and NIP must be unique');

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
                    // Skip empty rows
                    if (empty($row[0])) continue;

                    // Check for existing user
                    if (User::where('nip', $row[1])->orWhere('username', $row[2])->exists()) {
                        throw new \Exception("User with NIP '{$row[1]}' or username '{$row[2]}' already exists.");
                    }

                    // Validate required fields
                    if (empty($row[0]) || empty($row[1]) || empty($row[2]) || empty($row[3]) || empty($row[4])) {
                        throw new \Exception("Required user fields are missing.");
                    }

                    // Validate gender
                    if (!in_array(strtolower($row[4]), ['male', 'female'])) {
                        throw new \Exception("Invalid gender value. Must be 'male' or 'female'.");
                    }

                    // Create User
                    $user = User::create([
                        'nama' => $row[0],
                        'nip' => $row[1],
                        'username' => $row[2],
                        'email' => $row[3],
                        'password' => Hash::make(Str::random(8)), // Generate random password
                    ]);

                    // Create StudentDetail
                    StudentDetail::create([
                        'user_id' => $user->id,
                        'address' => $row[5],
                        'phone' => $row[6],
                        'birth_date' => $row[7],
                        'birth_place' => $row[8],
                        'gender' => strtolower($row[4]),
                        'sekolah' => $row[9],
                        'spp' => $row[10],
                        'no_rekening' => $row[11],
                        'nama_bank' => $row[12],
                        'cabang_bank' => $row[13],
                        'pemilik_rekening' => $row[14],
                        'tingkat_kelas' => $row[15],
                        'tahun_ajaran' => $row[16],
                        'nominal_spp_default' => $row[17],
                        'is_active' => true
                    ]);

                    // Create Father if name is provided
                    if (!empty($row[18])) {
                        FamilyMember::create([
                            'user_id' => $user->id,
                            'name' => $row[18],
                            'relationship' => 'father',
                            'occupation' => $row[19] ?? null,
                            'phone' => $row[20] ?? null,
                            'address' => $row[21] ?? null
                        ]);
                    }

                    // Create Mother if name is provided
                    if (!empty($row[22])) {
                        FamilyMember::create([
                            'user_id' => $user->id,
                            'name' => $row[22],
                            'relationship' => 'mother',
                            'occupation' => $row[23] ?? null,
                            'phone' => $row[24] ?? null,
                            'address' => $row[25] ?? null
                        ]);
                    }

                    // Create Sibling if name is provided
                    if (!empty($row[26])) {
                        FamilyMember::create([
                            'user_id' => $user->id,
                            'name' => $row[26],
                            'relationship' => 'sibling',
                            'occupation' => $row[27] ?? null,
                            'phone' => $row[28] ?? null,
                            'address' => $row[29] ?? null
                        ]);
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
