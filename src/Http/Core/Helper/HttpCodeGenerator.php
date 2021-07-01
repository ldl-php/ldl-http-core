<?php declare(strict_types=1);

namespace LDL\Http\Core\Helper;

use LDL\Http\Core\Collection\HttpCodeKeyCollection;
use LDL\Http\Core\Collection\HttpCodeKeyCollectionInterface;
use LDL\Http\Core\Collection\HttpCodeValueCollection;
use LDL\Http\Core\Collection\HttpCodeValueCollectionInterface;

class HttpCodeGenerator
{
    /**
     * Generates a list of HTTP code ranges which has the http code as it's value
     *
     * @param string $code
     * @param HttpCodeKeyCollectionInterface|null $collection
     *
     * @return HttpCodeKeyCollectionInterface
     *
     * @throws \Exception
     */
    public static function generateHttpCodeCollection(
        string $code,
        HttpCodeKeyCollectionInterface $collection=null
    ) : HttpCodeKeyCollectionInterface
    {
        $result = self::generateArray($code);

        if(null === $collection){
            return new HttpCodeKeyCollection($result);
        }

        foreach($result as $key => $value){
            $collection->append($value, $key);
        }

        return $collection;
    }

    /**
     * Generates a list of HTTP code ranges which has the HTTP code as the key and a custom $fill value
     *
     * @param string $code
     * @param mixed $fill
     * @param HttpCodeValueCollectionInterface|null $collection
     *
     * @return HttpCodeValueCollectionInterface
     *
     * @throws \Exception
     */

    public static function generateHttpCodeValueCollection(
        string $code,
        $fill,
        HttpCodeValueCollectionInterface $collection
    ) : HttpCodeValueCollectionInterface
    {
        $result = self::generateArray($code, $fill);

        if(null === $collection){
            return new HttpCodeValueCollection($result);
        }

        foreach($result as $key => $value){
            $collection->append($value, $key);
        }

        return $collection;
    }

    /**
     * Generates an array of HTTP codes, if the fill parameter is passed
     * the keys of the array will be the HTTP status codes, and the values will be filled with the $fill value.
     *
     * If $fill is null, an array containing HTTP codes as it's values will be returned.
     *
     * The $pattern parameter can be:
     *
     * A comma delimited list of status codes, such as: 200,300
     * A dash delimited range of codes, such as: 200-400
     * A single code, such as: 200
     *
     * @param string $pattern
     * @param string|null $fill
     * @return array|null
     */
    public static function generateArray(
        string $pattern,
        string $fill = null
    ) : ?array
    {
        if(filter_var($pattern, \FILTER_VALIDATE_INT)){
            return self::validateRange(null === $fill ? [(int) $pattern] : [(int) $pattern => $fill], null !== $fill);
        }

        if('any' === $pattern){
            $result = self::parseRange('100-599', $fill);
            return self::validateRange(null === $fill ? $result : array_keys($result), null !== $fill);
        }

        if(preg_match('#[0-9]+-[0-9]+#', $pattern)){
            $result = self::parseRange($pattern, $fill);
            return self::validateRange(null === $fill ? $result : array_keys($result), null !== $fill);
        }

        if(preg_match('#\,#', $pattern)){
            $result = self::parseCommaDelimitedRange($pattern, $fill);
            return self::validateRange(null === $fill ? $result : array_keys($result), null !== $fill);
        }

        return null;
    }

    private static function parseCommaDelimitedRange(
        string $responseCodes,
        string $fill=null
    ) : ?array
    {
        $codes = explode(',', $responseCodes);

        if(null === $fill) {
            return $codes;
        }

        $codes = array_flip(explode(',', $responseCodes));

        array_walk($codes, static function(&$value, $code) use($fill){
            $value = $fill;
        });

        return $codes;
    }

    private static function parseRange(
        string $responseCodes,
        string $fill=null
    ) : array
    {
        $codes = explode('-', $responseCodes);
        $start = (int) $codes[0];
        $end = (int) $codes[1];

        if($start >= $end){
            $msg = sprintf('Start HTTP code must be greater than ending HTTP code');
            throw new \InvalidArgumentException($msg);
        }

        if(null === $fill){
            return range($start, $end);
        }

        return array_map(static function() use ($fill){
            return $fill;
        }, array_flip(range($start, $end)));
    }

    private static function validateRange(array $result, bool $hasFill) : array
    {
        array_walk($result, static function(&$key, $value) use ($hasFill){
            if($hasFill){
                $key = (int) $value;
                return null;
            }

            $value = (int) $value;
        });

        return $result;
    }
}