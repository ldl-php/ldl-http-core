<?php declare(strict_types=1);

namespace LDL\Http\Core\Collection;

use LDL\Framework\Base\Collection\Contracts\CollectionInterface;
use LDL\Http\Core\Helper\HttpCodeGenerator;
use LDL\Http\Core\Validator\HttpCodeValidator;
use LDL\Type\Collection\AbstractCollection;
use LDL\Type\Collection\Traits\Validator\AppendValueValidatorChainTrait;

class HttpCodeKeyCollection extends AbstractCollection implements HttpCodeKeyCollectionInterface
{
    use AppendValueValidatorChainTrait;

    public function __construct(iterable $items = null)
    {
        parent::__construct($items);

        $this->getAppendValueValidatorChain()
            ->append(new HttpCodeValidator())
            ->lock();
    }

    public function appendRange($codeRange, $key = null): CollectionInterface
    {
        $range = HttpCodeGenerator::generateArray((string) $codeRange);

        foreach($range as $httpCode){
            if($this->hasValue($httpCode)){
                continue;
            }

            $this->setItem($httpCode);
            $this->setCount($this->count() + 1);
        }

        return $this;
    }

}