<?php declare(strict_types=1);

namespace App\Services\Readers\Factories;

use Illuminate\Support\Str;
use App\Services\Readers\Adapters\ReaderAdapter;
use App\Services\Readers\Adapters\Json\JsonReaderAdapter;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

class ReaderFactory
{
    public const ALLOWED_METHODS = [
        'makeJson'
    ];

    /**
     * Make the desired adapter
     *
     * @param string $format
     *
     * @return ReaderAdapter
     */
    public function make(string $format): ReaderAdapter
    {
        $method = 'make' . Str::studly(str_replace(['.', '-'], '_', $format));

        if (!method_exists($this, $method)) {
            throw new MethodNotAllowedException(self::ALLOWED_METHODS, "Method $method not found");
        }

        return $this->{$method}();
    }

    /**
     * Make Json reader adapter
     *
     * @return JsonReaderAdapter
     */
    private function makeJson(): JsonReaderAdapter
    {
        return new JsonReaderAdapter();
    }
}
