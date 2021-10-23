<?php

declare(strict_types=1);

namespace Noffily\Teapot\Core;

use PHPUnit\Framework\Assert;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Result
{
    private Request $request;
    private Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Checks that response code is equal to provided value.
     * @param int $code
     * @param string $message
     */
    public function seeResponseCodeIs(int $code, string $message = ''): void
    {
        Assert::assertEquals($code, $this->getResponse()->getStatusCode(), $message);
    }

    /**
     * Checks that response body contents matches the one provided
     * @param string $contents
     * @param string $message
     */
    public function seeResponseBodyContentsIs(string $contents, string $message = ''): void
    {
        Assert::assertSame($contents, $this->getResponse()->getContent(), $message);
    }

    protected function getRequest(): Request
    {
        return $this->request;
    }

    protected function getResponse(): Response
    {
        return $this->response;
    }
}
