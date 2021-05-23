<?php

namespace App\Console\Commands;

use App\Services\Readers\ReaderService;
use Exception;
use Illuminate\Console\Command;

class ReadJsonFile extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'pxl:read_json_file';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Read the json file';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws Exception
     */
    public function handle(ReaderService $readerService)
    {
        $adapter = $readerService->makeAdapter('json');
        $adapter->readFile(storage_path('app/public/challenge.json'));
        return 0;
    }
}
