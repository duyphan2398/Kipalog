<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Arr;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CsvService {
    protected $path;
    public function __construct($path)
    {
        $this->path = $path;
    }

    public function importCsv(){
        //Check file input
        /*$info = pathinfo($this->path);
        $info['extension']);*/
        $spreadsheet = IOFactory::load($this->path);
        $worksheet = $spreadsheet->getActiveSheet();
        $col = [];
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            if ($row->getRowIndex() == 1){
                foreach ($cellIterator as $cell) {
                   $col = Arr::add($col,$cell->getColumn(),$cell->getValue());
                }
            }
            else{
                $user = new User();
                foreach ($cellIterator as $cell) {

                        $user->{$col[$cell->getColumn()]}=  $cell->getValue();
                }
                /*Check existed*/
                $exist_user = User::where('username', $user->username)->orwhere('email', $user->email)->get();
                if (count($exist_user) == 0 ){
                    $user->save();
                }
            }
        }
        return true;
    }

    public function exportCsv(){
        $users = User::withTrashed()->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $row = 1;
        foreach ($users as $user) {
            $col = 'A';
            if ($row == 1){
                foreach($user->toArray() as $key => $value ) {
                    $sheet->setCellValue($col.$row, $key);
                    ++$col;
                }
                $col = 'A';
                ++$row;
            }
            foreach($user->toArray() as $key => $value ) {
                $sheet->setCellValue($col.$row, $value);
                ++$col;
            }
            ++$row;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($this->path);
        if(!empty($writer)){
            return true;
        }
        else{
            return false;
        };

    }

}
