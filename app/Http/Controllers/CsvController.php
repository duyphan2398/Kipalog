<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Services\CsvService;
class CsvController extends Controller {
    public function import(){
        $reader = new CsvService('csv/importUsers.xlsx');
        $reader->importCsv();
    }

    public function export(){
        $writer = new CsvService("csv/exportUsers.xlsx");
        $writer->exportCsv();
    }

}
