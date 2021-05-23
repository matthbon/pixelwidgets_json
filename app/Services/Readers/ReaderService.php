<?php declare(strict_types=1);

namespace App\Services\Readers;

use App\Services\Readers\Adapters\ReaderAdapter;
use App\Services\Readers\Factories\ReaderFactory;

class ReaderService
{
    /**
     * @var ReaderFactory
     */
    private $readerFactory;

    /**
     * ReaderService constructor.
     *
     * @param ReaderFactory $readerFactory
     */
    public function __construct(ReaderFactory $readerFactory)
    {
        $this->readerFactory = $readerFactory;
    }

    /**
     * Make the correct adapter in the factory with the format
     * @param string $format
     * @return ReaderAdapter
     */
    public function makeAdapter(string $format): ReaderAdapter
    {
        return $this->readerFactory->make($format);
    }
}
