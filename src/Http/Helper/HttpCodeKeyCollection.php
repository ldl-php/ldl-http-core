<?php declare(strict_types=1);

namespace LDL\Http\Helper;

use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Interfaces;
use LDL\Type\Collection\Traits\Validator\KeyValidatorChainTrait;
use LDL\Type\Collection\Traits\Validator\ValueValidatorChainTrait;
use LDL\Type\Collection\Types\Integer\Validator\IntegerValidator;
use LDL\Type\Collection\Validator\NumericRangeValidator;

class HttpCodeKeyCollection extends AbstractCollection implements HttpCodeKeyCollectionInterface
{
    use KeyValidatorChainTrait;
    use ValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getValueValidatorChain()
            ->append(new IntegerValidator())
            ->append(new NumericRangeValidator(100, 599))
            ->lock();

    }

    public function append($codeRange, $key = null): Interfaces\CollectionInterface
    {
        $range = HttpCodeGenerator::generateArray((string) $codeRange);

        foreach($range as $httpCode){
            if($this->hasValue($httpCode)){
                continue;
            }

            parent::append($httpCode, null);
        }

        return $this;
    }

}