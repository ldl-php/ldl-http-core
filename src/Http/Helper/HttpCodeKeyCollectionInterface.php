<?php declare(strict_types=1);

namespace LDL\Http\Helper;

use LDL\Type\Collection\Interfaces\CollectionInterface;
use LDL\Type\Collection\Interfaces\Validation\HasKeyValidatorChainInterface;
use LDL\Type\Collection\Interfaces\Validation\HasValueValidatorChainInterface;

interface HttpCodeKeyCollectionInterface extends CollectionInterface, HasKeyValidatorChainInterface, HasValueValidatorChainInterface
{

}