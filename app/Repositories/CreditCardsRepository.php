<?php declare(strict_types=1);

namespace App\Repositories;

use App\Models\CreditCard;

class CreditCardsRepository extends BaseRepository
{
    /**
     * CreditCardsRepository constructor.
     * @param string $modelName
     */
    public function __construct(string $modelName = CreditCard::class)
    {
        parent::__construct($modelName);
    }
}
