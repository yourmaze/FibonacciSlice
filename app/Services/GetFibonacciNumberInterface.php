<?php

declare(strict_types=1);

namespace Services;

interface GetFibonacciNumberInterface
{
    public function handle(int $position): int;
}
