<?php
namespace Mrlaozhou\Extend\Validation;

use Illuminate\Support\Collection;

class Validator
{

    /**
     * @var ValidationRuleParser
     */
    protected $ruleParser;

    /**
     * @var Collection
     */
    protected $_explicitRules;


    public function __construct()
    {
        $this->ruleParser           =   new ValidationRuleParser($this);
        $this->constructExplicitRulesCollection();
    }

    /**
     * 获取所有验证规则
     *
     * @return Collection
     */
    public function maps()
    {
        return Collection::make( $this->validatorMaps() );
    }

    /**
     * 获取所有验证规则(明确的 详细的)
     *
     * @return Collection
     */
    public function explicitRules()
    {
        return clone $this->_explicitRules;
    }

    /**
     * @param string $ruleName
     *
     * @return \Mrlaozhou\Extend\Validation\Rule|null
     */
    public function getRule(string $ruleName)
    {
        return $this->_explicitRules->get($ruleName);
    }

    /**
     * 验证规则解析器
     *
     * @return \Mrlaozhou\Extend\Validation\ValidationRuleParser
     */
    public function validationRuleParser()
    {
        return $this->ruleParser;
    }

    /**
     * @return array
     */
    protected function validatorMaps()
    {
        return require_once __DIR__ . '/../../data/validator_maps.php';
    }

    /**
     * 构造明确、明细的rules集合
     *
     * @return Collection
     */
    protected function constructExplicitRulesCollection()
    {
        $this->_explicitRules           =   new Collection();
        $this->maps()->map(function($description, $mixRule){
            //  解析rule
            $rule           =   $this->ruleParser->parse($mixRule, $description);
            $this->_explicitRules->put($rule->getName(), $rule);
        });
        return $this->_explicitRules;
    }
}