<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log; // Added this line

class UploadBankStatement extends Component
{
    use WithFileUploads;

    public $csv_file;
    public $headers = [];
    public $cleanedHeaders = [];
    public $previewData = [];
    public $selectedMapping = [];
    public $table = 'bank_statements';
    public $bank_id;

    public function mount($bank_id)
    {
        $this->bank_id = $bank_id;
    }


    public function updatedCsvFile()
    {
        $this->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $data = array_map('str_getcsv', file($this->csv_file->getRealPath()));

        $this->headers = $data[0]; // First row as CSV headers
        
        $this->cleanedHeaders = array_map(function($h) {
            $cleaned = trim(str_replace('.', '', $h));
            // This is the key line: replace characters that Livewire struggles with
            $sanitized = preg_replace('/[^a-zA-Z0-9_]/', '_', $cleaned);
            return $sanitized;
        }, $this->headers);

        // Initialize the selectedMapping with empty values using the sanitized headers
        $this->selectedMapping = array_combine($this->cleanedHeaders, array_fill(0, count($this->cleanedHeaders), ''));

        $this->previewData = array_slice($data, 1, 5); // Preview first 5 rows
    }


    // public function import()
    // {
    //     $this->validate([
    //         'csv_file' => 'required|file|mimes:csv,txt',
    //     ]);

    //     //dd(Auth::user());

    //     $company_id = Auth::user()->comp_id;
    //     $user_id = Auth::id();
    //     $bank_id = 5;

    //     $data = array_map('str_getcsv', file($this->csv_file->getRealPath()));
    //     $headers = array_shift($data); // Remove first row

    //     $columnMap = $this->selectedMapping;

    //     foreach ($data as $row) {
    //         $insertData = [];

    //         foreach ($columnMap as $csvColumn => $dbColumn) {
    //             $index = array_search($csvColumn, $headers);
    //             if ($dbColumn && $index !== false) {
    //                 $value = trim($row[$index] ?? null);

    //                 // Convert empty strings to null
    //                 if ($value === '') {
    //                     $value = null;
    //                 }

    //                 // Handle date parsing
    //                 if ($dbColumn === 'txn_date') {
    //                     $value = trim($value, "\"' \t\n\r\0\x0B");

    //                     if (!empty($value)) {
    //                         try {
    //                             $value = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $value)->format('Y-m-d H:i:s');
    //                         } catch (\Exception $e) {
    //                             try {
    //                                 $value = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $value)->format('Y-m-d H:i:s');
    //                             } catch (\Exception $e) {
    //                                 $value = null;
    //                             }
    //                         }
    //                     } else {
    //                         $value = null;
    //                     }
    //                 }

    //                 // Convert money fields
    //                 if (in_array($dbColumn, ['debit', 'credit', 'balance']) && $value !== null) {
    //                     $value = floatval(str_replace(',', '', $value));
    //                 }

    //                 $insertData[$dbColumn] = $value;
    //             }
    //         }

    //         $insertData['company_id'] = $company_id;
    //         $insertData['uploaded_by'] = $user_id;
    //         $insertData['bank_id'] = $this->bank_id;
    //         $insertData['created_at'] = \Carbon\Carbon::now();
    //         $insertData['updated_at'] = \Carbon\Carbon::now();


    //         DB::table($this->table)->insert($insertData);
    //     }

    //     session()->flash('success', 'CSV imported successfully!');
    //     return redirect()->route('bank.statements', $this->bank_id); // Optional redirect
    // }


    public function import()
    {
        $this->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $company_id = Auth::user()->comp_id;
        $user_id = Auth::id();

        $data = array_map('str_getcsv', file($this->csv_file->getRealPath()));
        $headers = array_shift($data); // CSV header row

        $columnMap = $this->selectedMapping;

        $bulkInsert = [];

        foreach ($data as $rowIndex => $row) {
            $insertData = [];

            foreach ($columnMap as $csvColumn => $dbColumn) {
                $index = array_search($csvColumn, $headers);
                if ($dbColumn && $index !== false) {
                    $value = trim($row[$index] ?? '');

                    // Convert empty strings to null
                    $value = $value === '' ? null : $value;

                    // Handle date parsing
                    if ($dbColumn === 'txn_date') {
                        $value = trim($value, "\"' \t\n\r\0\x0B");

                        if (!empty($value)) {
                            try {
                                $value = \Carbon\Carbon::createFromFormat('d-m-Y H:i:s', $value)->format('Y-m-d H:i:s');
                            } catch (\Exception $e) {
                                try {
                                    $value = \Carbon\Carbon::createFromFormat('d-m-Y H:i', $value)->format('Y-m-d H:i:s');
                                } catch (\Exception $e) {
                                    $this->addError('csv_file', "Invalid date format on row " . ($rowIndex + 2));
                                    return;
                                }
                            }
                        } else {
                            $this->addError('csv_file', "Missing date on row " . ($rowIndex + 2));
                            return;
                        }
                    }

                    // Convert money fields
                    if (in_array($dbColumn, ['debit', 'credit', 'balance']) && $value !== null) {
                        $value = floatval(str_replace(',', '', $value));
                    }

                    $insertData[$dbColumn] = $value;
                }
            }

            // Validate required fields before inserting
            if (empty($insertData['txn_date']) || (!isset($insertData['credit']) && !isset($insertData['debit']))) {
                $this->addError('csv_file', "Missing critical data on row " . ($rowIndex + 2));
                return;
            }

            // Append metadata
            $insertData['company_id'] = $company_id;
            $insertData['uploaded_by'] = $user_id;
            $insertData['bank_id'] = $this->bank_id;
            $insertData['created_at'] = \Carbon\Carbon::now();
            $insertData['updated_at'] = \Carbon\Carbon::now();

            $bulkInsert[] = $insertData;
        }

        // Insert all rows at once
        if (!empty($bulkInsert)) {
            DB::table($this->table)->insert($bulkInsert);
        }

        session()->flash('success', 'CSV imported successfully!');
        return redirect()->route('bank.statements', $this->bank_id);
    }



    public function render()
    {
        $dbColumns = Schema::getColumnListing($this->table);

        return view('livewire.upload-bank-statement', [
            'dbColumns' => $dbColumns,
        ]);
    }
    
}