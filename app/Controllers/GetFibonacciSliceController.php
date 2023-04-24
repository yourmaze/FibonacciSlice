<?php

declare(strict_types=1);


use Route\Request;
use Services\CalcFibonacciBineFormulaService;
use Services\GetCacheableNumberService;
use Validators\GetFibonacciSliceValidator;

final class GetFibonacciSliceController implements ControllerInterface
{
    private Redis $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function handle(Request $request): string
    {
        $data = (new GetFibonacciSliceValidator())->validate($request->params());

        $numbers = (new GetCacheableNumberService(
            new CalcFibonacciBineFormulaService(),
            $data,
            $this->redis
        ))->handle();

        return json_encode($numbers, JSON_THROW_ON_ERROR);
    }
}
