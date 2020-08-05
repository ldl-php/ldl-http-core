<?php

namespace LDL\Http\Core\Response;

use Symfony\Component\HttpFoundation\Response as SymfonyResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class Response extends SymfonyResponse implements ResponseInterface
{
    public function getHeaderBag(): ResponseHeaderBag
    {
        return $this->headers;
    }
}
