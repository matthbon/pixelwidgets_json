<?php declare(strict_types=1);

namespace App\Services\Readers\Adapters;
use App\Models\Account;
use App\Models\CreditCard;
use App\Models\ReaderImport;
use App\Repositories\AccountsRepository;
use App\Repositories\CreditCardsRepository;
use App\Repositories\ReaderImportsRepository;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

abstract class ReaderAdapter implements ReaderAdapterInterface
{
    /**
     * @var string
     */
    protected $file;

    /**
     * @var int
     */
    protected $startIdx;

    /**
     * @var ReaderImport
     */
    protected $readerImport;

    /**
     * @var ReaderImportsRepository
     */
    protected $readerImportsRepository;

    /**
     * @var AccountsRepository
     */
    protected $accountsRepository;

    /**
     * @var CreditCardsRepository
     */
    protected $creditCardsRepository;

    /**
     * ReaderAdapter constructor.
     */
    public function __construct()
    {
        $this->readerImportsRepository = new ReaderImportsRepository();
        $this->accountsRepository = new AccountsRepository();
        $this->creditCardsRepository = new CreditCardsRepository();
    }

    /**
     * Check if file exists. Else throw file not found exception
     * @throws FileNotFoundException
     */
    protected function checkFileExists(): void
    {
        if (!file_exists($this->file)) {
            throw new FileNotFoundException("File $this->file not found");
        }
    }

    /**
     * Start a new reader import
     */
    protected function startReaderImport(): void
    {
        $readerImport = $this->readerImportsRepository->getFirstBy('file_name', $this->file);
        // If not previously started and stopped for some reason, create a new one
        if ($readerImport === null) {
            $readerImport = $this->readerImportsRepository->new([
                'file_name' => $this->file,
            ]);
            $this->readerImportsRepository->save($readerImport);
        }

        $this->startIdx = $readerImport->idx;
        $this->readerImport = $readerImport;
    }

    protected function stopReaderImport(): void
    {
        $this->readerImportsRepository->delete($this->readerImport);
    }

    /**
     * Store the index to database for reader import
     * @param int $idx
     */
    protected function storeIndexToReaderImport(int $idx): void
    {
        $this->readerImport->idx = $idx;
        $this->readerImportsRepository->save($this->readerImport);
    }

    /**
     * Store account and return it
     * @param array $data
     * @return Account
     */
    protected function storeAccount(array $data): Account
    {
        $account = $this->accountsRepository->new($data);
        $this->accountsRepository->save($account);
        return $account;
    }

    /**
     * Store credit card and return it
     * @param int $accountId
     * @param array $data
     * @return CreditCard
     */
    protected function storeCreditCard(int $accountId, array $data): CreditCard
    {
        $creditCard = $this->creditCardsRepository->new($data);
        $creditCard->account_id = $accountId;
        $this->creditCardsRepository->save($creditCard);
        return $creditCard;
    }
}
