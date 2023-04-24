<?php

declare(strict_types=1);

namespace Services;

final class CalcFibonacciBineFormulaService implements GetFibonacciNumberInterface
{
    /**
     * @param int $position
     * @return int
     */
    public function handle(int $position): int
    {
        $phi = (1 + sqrt(5)) / 2;

        return (int)round((($phi ** $position) - ((1 - $phi) ** $position)) / sqrt(5));
    }
}
