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
        return $this->isMethod('OPTIONS');
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
}
