<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;
use Illuminate\Support\Facades\Storage;

class DBBackup extends Command
{
    /**
     * make:command cmd_name
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:dbbackup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //$path : where we store the file
        $path = Storage::path("/backup/".now()->format("d-m-Y-H-i-s").".gz");
        $cmd = "mysqldump --user=".env('DB_USERNAME')." --password=".env('DB_PASSWORD')." --host=". env('DB_HOST')." ".env('DB_DATABASE'). " | gzip > ". $path;

        $process = Process::run($cmd);

        if($process->successful()) {
            $this->info('Database backup saved as :'. basename($path));
        }
        /* to run in terminal : php artisan app:dbbackup */
    }
}
