<?php declare(strict_types=1);

namespace LDL\Http\Core\Collection;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Http\Core\Helper\HttpCodeGenerator;
use LDL\Http\Core\Validator\HttpCodeValidator;
use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\AppendKeyValidatorChainTrait;

class HttpCodeValueCollection extends AbstractCollection implements HttpCodeValueCollectionInterface
{
    use AppendKeyValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendKeyValidatorChain()
            ->append(new HttpCodeValidator())
            ->lock();
    }

    public function appendRange($value, $key = null): CollectionInterface
    {
        $range = HttpCodeGenerator::generateArray((string) $key);

        foreach($range as $httpCode){
            if($this->hasKey($httpCode)){
                continue;
            }

            $this->setItem($value, $httpCode);
            $this->setCount($this->count() + 1);
        }

        return $this;
    }
}