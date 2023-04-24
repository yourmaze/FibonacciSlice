<?php

declare(strict_types=1);

use Route\Request;

interface ResponseInterface
{
    public function handle(Request $request): mixed;
}
