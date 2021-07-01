<?php declare(strict_types=1);

namespace LDL\Http\Core\Validator;

use LDL\Framework\Helper\ComparisonOperatorHelper;
use LDL\Validators\Chain\AndValidatorChain;
use LDL\Validators\IntegerValidator;
use LDL\Validators\NumericComparisonValidator;
use LDL\Validators\ValidatorInterface;

class HttpCodeValidator implements ValidatorInterface
{
    /**
     * @var AndValidatorChain
     */
    private $chain;

    public function __construct()
    {
        $this->chain = (new AndValidatorChain([
            new IntegerValidator(),
            new NumericComparisonValidator(100,ComparisonOperatorHelper::OPERATOR_GTE),
            new NumericComparisonValidator(599,ComparisonOperatorHelper::OPERATOR_LTE)
        ]))->lock();
    }

    public function validate($value): void
    {
        $this->chain->validate($value);
    }

    public function assertTrue($value): void
    {
        /**
         * @var ValidatorInterface $validator
         */
        foreach($this->chain as $validator){
            $validator->assertTrue($value);
        }
    }
}