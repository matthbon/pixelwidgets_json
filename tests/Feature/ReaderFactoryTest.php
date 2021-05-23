<?php

namespace Tests\Feature;

use App\Services\Readers\Factories\ReaderFactory;
use Tests\TestCase;

class ReaderFactoryTest extends TestCase
{
    /**
     * Test that correct idx is true
     */
    public function testHasNoValidMethod(): void
    {
        $this->expectErrorMessage('Method makeCsv not found');
        $factory = new ReaderFactory();
        $factory->make('csv');
    }
}
