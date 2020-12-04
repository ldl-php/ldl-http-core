<?php declare(strict_types=1);

namespace LDL\Http\Helper;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces;
use LDL\Type\Collection\Traits\Validator\KeyValidatorChainTrait;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Types\Integer\Validator\IntegerItemValidator;
use LDL\Type\Collection\Types\Integer\Validator\IntegerValidator;
use LDL\Type\Collection\Validator\NumericRangeValidator;

class HttpCodeValueCollection extends AbstractCollection implements HttpCodeValueCollectionInterface
{
    use ValueValidatorChainTrait;
    use KeyValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getKeyValidatorChain()
            ->append(new IntegerValidator())
            ->append(new NumericRangeValidator(100, 599))
            ->lock();
    }

    public function append($value, $key = null): Interfaces\CollectionInterface
    {
        $range = HttpCodeGenerator::generateArray((string) $key);

        foreach($range as $httpCode){
            if($this->hasKey($httpCode)){
                continue;
            }

            parent::append($value, $httpCode);
        }

        return $this;
    }

}