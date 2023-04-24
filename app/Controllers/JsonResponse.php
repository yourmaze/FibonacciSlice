<?php

declare(strict_types=1);


use Route\Request;

final class JsonResponse implements ResponseInterface
{
    private ControllerInterface $controller;

    public function __construct(ControllerInterface $controller)
    {
        $this->controller = $controller;
    }

    public function handle(Request $request): string
    {
        try {
            $data = $this->controller->handle($request);
        } catch (Throwable $e) {
            $data = $e->getMessage();
        }

        return json_encode($data, JSON_THROW_ON_ERROR);
    }
}
