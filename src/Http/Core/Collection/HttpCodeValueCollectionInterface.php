<?php declare(strict_types=1);

namespace LDL\Http\Core\Collection;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendKeyValidatorChainInterface;
use LDL\Type\Collection\TypedCollectionInterface;

interface HttpCodeValueCollectionInterface extends TypedCollectionInterface, HasAppendKeyValidatorChainInterface
{
    /**
     * @param $value
     * @param null $key
     * @return CollectionInterface
     */
    public function appendRange($value, $key = null): CollectionInterface;
}