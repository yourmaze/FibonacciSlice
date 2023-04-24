<?php
declare(strict_types=1);

namespace Route;

final class Request
{
    private array $request;
    private array $params;

    /**
     * @param array<string, mixed> $request
     * @param array $params
     */
    public function __construct(array $request, array $params)
    {
        $this->request = $request;
        $this->params = $params;
    }

    public function uri(): string
    {
        return parse_url($this->request['REQUEST_URI'], PHP_URL_PATH);
    }

    /**
     * @return array
     */
    public function params(): array
    {
        return $this->params;
    }

    public function isPost(): bool
    {
        return $this->request['REQUEST_METHOD'] === 'POST';
    }

    public function isGet(): bool
    {
        return $this->request['REQUEST_METHOD'] === 'GET';
    }
}
