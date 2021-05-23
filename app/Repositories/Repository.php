<?php declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

interface Repository
{
    /**
     * @param int   $id
     * @param array $with
     *
     * @return Model
     */
    public function findById(int $id, array $with = []): Model;

    /**
     * @param        $key
     * @param        $value
     * @param string $operator
     * @param array  $with
     *
     * @return Model
     */
    public function getFirstBy($key, $value, $operator = '=', array $with = []): ?Model;

    /**
     * @param array $with
     *
     * @return Builder
     */
    public function make(array $with = []): Builder;

    /**
     * @param array $data
     *
     * @return mixed
     */
    public function new(array $data): Model;

    /**
     * @param Model $model
     *
     * @return bool
     */
    public function save(Model $model): bool;

    /**
     * @param Model $model
     *
     * @return bool
     */
    public function delete(Model $model): bool;

    /**
     * @return int
     */
    public function truncate(): int;

    /**
     * @param string $modelName
     */
    public function setModel(string $modelName): void;
}
