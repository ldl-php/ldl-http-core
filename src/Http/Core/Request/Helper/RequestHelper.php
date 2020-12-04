<?php declare(strict_types=1);

namespace LDL\Http\Core\Request\Helper;

use LDL\Http\Core\Request\RequestInterface;

class RequestHelper
{
    /**
     * @param string $method
     * @return bool
     */
    public static function isHttpMethodValid(string $method): bool
    {
        return in_array($method, self::getAvailableHttpMethods(), true);
    }

    /**
     * @return array
     */
    public static function getAvailableHttpMethods(): array
    {
        return [
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
    }
}