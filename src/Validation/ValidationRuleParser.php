<?php
namespace Mrlaozhou\Extend\Validation;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class ValidationRuleParser
{

    /**
     * @var Validator
     */
    protected $validator;

    public function __construct(Validator $validator)
    {
        $this->validator        =   $validator;
    }

    /**
     * @param        $mixedRule
     * @param string $description
     * @return \Mrlaozhou\Extend\Validation\Rule
     */
    public function parse($mixedRule, string $description = '')
    {
        //  提取rule
        list( $ruleName, $ruleParameter )   =   $this->explodeMixedRule($mixedRule);
        //  提取参数
        list( $parameters, $hasUnlimited )  =   $this->explodeRuleParameter($ruleParameter);
        return new Rule( $ruleName, $description, $mixedRule, $parameters, $hasUnlimited );
    }

    /**
     * @param $mixedRule
     *
     * @return array
     */
    public function explodeMixedRule($mixedRule)
    {
        $exploded                   =   explode(':', $mixedRule);
        return [ $exploded[0], $exploded[1] ?? '' ];
    }

    /**
     * @param string $ruleParameter
     *
     * @return array
     */
    public function explodeRuleParameter(string $ruleParameter)
    {
        if( Str::contains( $ruleParameter, '...' ) ) {
            //  替换 ...
            $ruleParameter          =   Str::replaceFirst('...', '', $ruleParameter);
            $hasUnlimited           =   true;
        } else {
            $hasUnlimited           =   false;
        }
        $parameters             =   array_filter(explode(',', $ruleParameter));
        return [$parameters, $hasUnlimited];
    }
}