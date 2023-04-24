<?php

declare(strict_types=1);

use Route\Request;

interface ControllerInterface
{
    public function handle(Request $request): string;
}
