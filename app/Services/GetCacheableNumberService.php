<?php

declare(strict_types=1);

namespace Services;

use Redis;
use Validators\Commands\GetFibonacciSliceCommand;

final class GetCacheableNumberService
{
    private GetFibonacciNumberInterface $service;
    private GetFibonacciSliceCommand $command;
    private Redis $redis;

    public function __construct(
        GetFibonacciNumberInterface $service,
        GetFibonacciSliceCommand $command,
        Redis $redis
    ) {
        $this->service = $service;
        $this->command = $command;
        $this->redis = $redis;
    }

    /**
     * @return int[]
     */
    public function handle(): array
    {
        $positions = range($this->command->from, $this->command->to);

        $slice = [];

        foreach ($positions as $position) {
            if ($this->notInCache($position)) {
                $value = $this->service->handle($position);
                $slice[] = $value;
                $this->setToCache($position, $value);
            } else {
                $slice[] = $this->getFromCache($position);
            }
        }

        return $slice;
    }

    public function notInCache(int $position): bool
    {
        return !$this->redis->exists((string)$position);
    }

    public function getFromCache(int $position): int
    {
        return (int)$this->redis->get((string)$position);
    }

    public function setToCache(int $key, int $value): void
    {
        $this->redis->set((string)$key, $value);
    }
}
