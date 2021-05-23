<?php declare(strict_types=1);

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements Repository
{
    /**
     * @var Model
     */
    protected $model;
    /**
     * @var string
     */
    protected $modelName;

    /**
     * BaseRepository constructor.
     * @param string $modelName
     */
    public function __construct($modelName = '')
    {
        $this->modelName = $modelName;
        $this->setModel($this->modelName);
    }

    /**
     * @inheritDoc
     */
    public function findById(int $id, array $with = [], array $columns = ['*']): Model
    {
        return $this->make($with)->findOrFail($id, $columns);
    }

    /**
     * @inheritDoc
     */
    public function getFirstBy($key, $value, $operator = '=', array $with = [], array $columns = ['*']): ?Model
    {
        return $this->make($with)->where($key, $operator, $value)->first($columns);
    }

    /**
     * @inheritDoc
     */
    public function make(array $with = []): Builder
    {
        return $this->model::with($with);
    }

    /**
     * @inheritDoc
     */
    public function new(array $data = []): Model
    {
        return $this->model->newInstance($data);
    }

    /**
     * @inheritDoc
     */
    public function save(Model $model): bool
    {
        return $model->save();
    }

    /**
     * @inheritDoc
     *
     * @throws \Exception
     */
    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    /**
     * @inheritDoc
     */
    public function truncate(): int
    {
        return $this->model->newQuery()->delete();
    }

    /**
     * @inheritDoc
     */
    final public function setModel(string $modelName): void
    {
        $this->model = class_exists('\App') ? \App::make($modelName) : new $modelName();
    }
}
