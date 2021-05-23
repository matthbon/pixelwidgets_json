<?php declare(strict_types=1);

namespace App\Services\Readers\Adapters;

interface ReaderAdapterInterface
{
    public function readFile(string $file);
}
