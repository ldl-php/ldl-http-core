<?php declare(strict_types=1);

namespace LDL\Http\Core\Collection;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\HasAppendValueValidatorChainInterface;
use LDL\Type\Collection\TypedCollectionInterface;

interface HttpCodeKeyCollectionInterface extends TypedCollectionInterface, HasAppendValueValidatorChainInterface
{
    /**
     * @param mixed $codeRange
     * @param null $key
     * @return CollectionInterface
     */
    public function appendRange($codeRange, $key = null): CollectionInterface;
}