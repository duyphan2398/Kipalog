<?php

namespace App\Console\Commands;

use App\Services\CsvService;
use Illuminate\Console\Command;
use mysql_xdevapi\Exception;

class ImportCsvUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:user {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import User';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $reader = new CsvService($this->option('path'));
        ;
        if ($reader->importCsv()){
            $this->info('Done');
        }else{
            $this->error("Check Path Again");
        };
    }

}
