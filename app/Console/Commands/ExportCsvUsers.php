<?php

namespace App\Console\Commands;

use App\Services\CsvService;
use Illuminate\Console\Command;

class ExportCsvUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:user {--path=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Export User';

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
        $writer = new CsvService($this->option('path'));

        if ($writer->exportCsv()){
            $this->info('Done');
        }else{
            $this->error("Check Path Again");
        };

    }
}
