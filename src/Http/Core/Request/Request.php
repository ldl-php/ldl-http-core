<?php

namespace LDL\Http\Core\Request;

use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request as SymfonyRequest;

class Request extends SymfonyRequest implements RequestInterface
{
    /**
     * {@inheritdoc}
     */
    public function isPreFlight(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_OPTIONS);
    }

    /**
     * {@inheritdoc}
     */
    public function getHeaderBag(): HeaderBag
    {
        return $this->headers;
    }

    public function getClientIp(): string
    {
        return parent::getClientIp();
    }

    public function getQuery(): ParameterBag
    {
        return $this->query;
    }

    /**
     * {@inheritdoc}
     */
    public function isHttpMethodValid(): bool
    {
        $validTypes = [
            RequestInterface::HTTP_METHOD_OPTIONS,
            RequestInterface::HTTP_METHOD_HEAD,
            RequestInterface::HTTP_METHOD_GET,
            RequestInterface::HTTP_METHOD_POST,
            RequestInterface::HTTP_METHOD_PUT,
            RequestInterface::HTTP_METHOD_PATCH,
            RequestInterface::HTTP_METHOD_DELETE,
            RequestInterface::HTTP_METHOD_PURGE,
            RequestInterface::HTTP_METHOD_TRACE,
            RequestInterface::HTTP_METHOD_CONNECT
        ];

        return in_array($this->getMethod(), $validTypes, true);
    }

    /**
     * {@inheritdoc}
     */
    public function isHead(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_HEAD);
    }

    /**
     * {@inheritdoc}
     */
    public function isGet(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_GET);
    }

    /**
     * {@inheritdoc}
     */
    public function isPost(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_POST);
    }

    /**
     * {@inheritdoc}
     */
    public function isPut(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_PUT);
    }

    /**
     * {@inheritdoc}
     */
    public function isPatch(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_PATCH);
    }

    /**
     * {@inheritdoc}
     */
    public function isDelete(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_DELETE);
    }

    /**
     * {@inheritdoc}
     */
    public function isPurge(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_PURGE);
    }

    /**
     * {@inheritdoc}
     */
    public function isTrace(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_TRACE);
    }

    /**
     * {@inheritdoc}
     */
    public function isConnect(): bool
    {
        return $this->isMethod(RequestInterface::HTTP_METHOD_CONNECT);
    }
}
