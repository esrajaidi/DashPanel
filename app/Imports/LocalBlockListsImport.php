<?php

namespace App\Imports;

use App\Models\LocalBlockLists;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class LocalBlockListsImport implements ToModel , WithStartRow 
{

    protected $fileName;

 function __construct($fileName) {
        $this->fileName = $fileName;
 }

    /**
 * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       
        
        

        return new LocalBlockLists([
           'statement' => trim($row[1]),
           'hiddenBy'=>trim($row[2]),
           'dateofreceivedMessage' => $this->convertToDateTime($row[3]),
           'index' => trim($row[4]),
           'notes' => ($row[5]== null) ? null : trim($row[5]),
           'statu' => ($row[5]== null) ? 1 : 0,
           'file_name'=> $this->fileName,

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function convertToDateTime($datetime){
        
        $int = (int)$datetime;
       return Date::excelToDateTimeObject($int);
       
       
    }
       
    
}
