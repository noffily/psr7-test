<?php

declare(strict_types=1);

namespace Noffily\Teapot\Core;

use Noffily\Teapot\Request\RequestAdapterFactory;
use Psr\Http\Message\ServerRequestInterface as PsrServerRequest;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

final class Runner
{
    private PsrServerRequest|SymfonyRequest $request;
    private Emitter $emitter;

    public function __construct(Emitter $emitter)
    {
        $this->emitter = $emitter;
    }

    public function addRequest(PsrServerRequest|SymfonyRequest $request): void
    {
        $this->request = $request;
    }

    public function execute(): Result
    {
        $emitter = $this->emitter;

        return new Result(
            (new RequestAdapterFactory($this->request))->create()->adapt(),
            $emitter($this->request)->create()->adapt()
        );
    }
}