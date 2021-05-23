<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\ReaderImport;

class ReaderImportsRepository extends BaseRepository
{
    /**
     * ReaderImportsRepository constructor.
     * @param string $modelName
     */
    public function __construct(string $modelName = ReaderImport::class)
    {
        parent::__construct($modelName);
    }
}
