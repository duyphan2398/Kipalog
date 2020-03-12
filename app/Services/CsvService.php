<?php

namespace App\Services;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CsvService {
    protected $path;
    protected $file_format = ['csv', 'xlsx', 'xls'];
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
        $highestRow = $worksheet->getHighestRow(); // e.g. 3
        $highestColumn = $worksheet->getHighestColumn(); // e.g 'K'
        $highestColumn++;
        for ($row = 2; $row <= $highestRow; ++$row) {
            $user = new User();
            for ($col = 'A'; $col != $highestColumn; ++$col) {
                switch ($col){
                    case "B":
                        $user->name = $worksheet->getCell($col.$row)->getValue();
                        break;
                    case "C":
                        $user->username = $worksheet->getCell($col.$row)->getValue();
                        break;
                    case "D":
                        $user->email = $worksheet->getCell($col.$row)->getValue();
                        break;
                    case "E" :
                        $user->avatar = $worksheet->getCell($col.$row)->getValue();
                        break;
                    case "G" :
                        $user->password = $worksheet->getCell($col.$row)->getValue();
                        break;
                    default :
                        break;
                }
            }
            $exist_user = User::where('username', $user->username)->orwhere('email', $user->email)->get();
            if (count($exist_user) == 0 ){
                $user->save();
            }
        }
    }

    public function exportCsv(){
        $users = User::withTrashed()->get();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Id');
        $sheet->setCellValue('B1', 'Name');
        $sheet->setCellValue('C1', 'Username');
        $sheet->setCellValue('D1', 'Email');
        $sheet->setCellValue('E1', 'Avatar');
        $sheet->setCellValue('F1', 'Emai_verified_at');
        $sheet->setCellValue('G1', 'Password');
        $sheet->setCellValue('H1', 'Remember_token');
        $sheet->setCellValue('I1', 'created_at');
        $sheet->setCellValue('J1', 'updated_at');
        $sheet->setCellValue('K1', 'deleted_at');
        $row = 2;
        foreach ($users as $user) {
            $col = 'A';
            foreach($user->toArray() as $key => $value ) {
                $sheet->setCellValue($col.$row, $value);
                ++$col;
            }
            ++$row;
        }
        $writer = new Xlsx($spreadsheet);
        $writer->save($this->path);

    }

}
