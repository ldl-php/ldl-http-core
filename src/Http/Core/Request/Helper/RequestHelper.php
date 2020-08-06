<?php

use LDL\Http\Core\Request\RequestInterface;

class RequestHelper
{
    /**
     * {@inheritdoc}
     */
    public static function isHttpMethodValid(string $method): bool
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

        return in_array($method, $validTypes, true);
    }
}