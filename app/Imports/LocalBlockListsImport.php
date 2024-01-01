<?php

namespace App\Imports;

use App\Models\LocalBlockLists;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

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
         'rt' => $row[0],
           'statement' => trim($row[1]),
           'hiddenBy'=>trim($row[2]),
           'dateofreceivedMessage' => $this->convertToDateTime($row[3]),
           'index' => trim($row[4]),
           'notes' => trim($row[5]),
           'statu' => ($row[5]== null) ? 1 : 0,
           'file_name'=> $this->fileName,

        ]);
    }

    public function startRow(): int
    {
        return 2;
    }

    public function convertToDateTime($datetime){
        

        $date = str_replace('.', '-', $datetime);
        $newDate = date("Y-m-d", strtotime($date));
       return $newDate;
    }
       
    
}
