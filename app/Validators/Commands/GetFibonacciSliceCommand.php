<?php

declare(strict_types=1);

namespace Validators\Commands;

final class GetFibonacciSliceCommand
{
    public function __construct(
        public int $from,
        public int $to,
    ) {
    }
}
