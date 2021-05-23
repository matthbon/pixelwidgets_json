<?php declare(strict_types=1);

namespace App\Services\Readers\Adapters\Json;

use App\Rules\HasCorrectIdx;
use App\Rules\ValidAge;
use App\Services\Readers\Adapters\ReaderAdapter;
use Exception;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Validator;
use JsonMachine\JsonMachine;

class JsonReaderAdapter extends ReaderAdapter
{
    /**
     * Read file in json format
     * @param string $file
     * @throws FileNotFoundException|Exception
     */
    public function readFile(string $file): void
    {
        try {
            $this->file = $file;
            $this->checkFileExists();
            $this->startReaderImport();
            $challenges = JsonMachine::fromFile($this->file);

            foreach ($challenges as $idx => $values) {
                $values['idx'] = $idx;
                $passes = Validator::make($values, [
                    'idx' => [new HasCorrectIdx($this->startIdx)],
                    'date_of_birth' => [new ValidAge],
                ])->passes();

                // If passes store account and credit card to db
                if ($passes) {
                    $account = $this->storeAccount($values);
                    $this->storeCreditCard($account->id, $values['credit_card']);
                }
                // Store + 1 so we know where to start
                $this->storeIndexToReaderImport($idx + 1);
            }
            $this->stopReaderImport();
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
            // Do something with exception like to slack or Log
        }
    }
}
