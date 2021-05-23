<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\Account;

class AccountsRepository extends BaseRepository
{
    /**
     * AccountsRepository constructor.
     * @param string $modelName
     */
    public function __construct(string $modelName = Account::class)
    {
        parent::__construct($modelName);
    }
}
