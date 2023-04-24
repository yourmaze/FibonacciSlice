<?php

declare(strict_types=1);

namespace Validators;

use RuntimeException;
use Validators\Commands\GetFibonacciSliceCommand;

final class GetFibonacciSliceValidator
{
    public function validate(array $data): GetFibonacciSliceCommand
    {
        $data = $this->checkRules($data);

        return new GetFibonacciSliceCommand(
            $data['from'],
            $data['to'],
        );
    }

    /**
     * @throws RuntimeException
     */
    private function checkRules(array $data): array
    {
        $rules = ['from', 'to'];
        $validatedData = [];

        foreach ($rules as $rule) {
            if (isset($data[$rule]) && is_numeric($data[$rule])) {
                $validatedData[$rule] = (int)$data[$rule];
            }
        }

        if ($this->isNotValidData($rules, $validatedData)) {
            throw new RuntimeException('Не валидные данные');
        }

        return $validatedData;
    }

    private function isNotValidData($rules, $validatedData): bool
    {
        return count($rules) !== count($validatedData) ||
            $validatedData['from'] > $validatedData['to'] ||
            $validatedData['from'] < 1 ||
            $validatedData['from'] > 90 ||
            $validatedData['to'] < 1 ||
            $validatedData['to'] > 90;
    }
}
