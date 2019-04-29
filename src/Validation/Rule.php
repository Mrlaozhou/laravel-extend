<?php
namespace Mrlaozhou\Extend\Validation;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use \JsonSerializable;
use \ArrayAccess;

class Rule implements ArrayAccess, Arrayable, Jsonable, JsonSerializable
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @var string
     */
    protected $mixedRule;

    /**
     * @var bool
     */
    protected $hasUnlimited;

    /**
     * @var array
     */
    protected $actualParameters = [
        'parameters'            =>  [],
        'unlimitedParameters'   =>  []
    ];


    public function __construct(string $name, string $description, string $mixedRule, array $parameters = [], $hasUnlimited = false)
    {
        $this->name             =   $name;
        $this->description      =   $description;
        $this->parameters       =   $parameters;
        $this->mixedRule        =   $mixedRule;
        $this->hasUnlimited     =   $hasUnlimited;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @return array
     */
    public function getParameters()
    {
        return $this->parameters;
    }

    /**
     * @return string
     */
    public function getMixedRule()
    {
        return $this->mixedRule;
    }

    /**
     * @return bool
     */
    public function isUnlimited()
    {
        return $this->hasUnlimited;
    }

    /**
     * 设置实际参数
     *
     * @param array $parameters
     * @param array $unlimitedParameters
     */
    public function setActualParameters(array $parameters, array $unlimitedParameters = [])
    {
        $this->actualParameters     =   compact('parameters', 'unlimitedParameters');
    }

    /**
     * @return array
     */
    public function getActualParameters()
    {
        return $this->actualParameters;
    }

    /**
     * 填充rule参数
     *
     * @param array $parameters
     * @param  array $unlimitedParameters
     * @return string
     */
    public function fillRuleParameters()
    {
        //  解析参数
        list( $parameters, $unlimitedParameters )   =   ($mixedParameters = func_get_args())
            ?   $mixedParameters    :   array_values($this->getActualParameters());
        //  原始混合rule
        $mixedRule              =   $this->getMixedRule();
        //  遍历参数->替换
        foreach ($this->getParameters() as $parameterName) {
            $mixedRule          =   Str::replaceFirst(trim($parameterName), trim( $parameters[$parameterName] ?? '' ), $mixedRule);
        }
        //  是否有无限参数
        if( $this->isUnlimited() ) {
            $mixedRule          =   Str::replaceFirst('...', implode(',', $unlimitedParameters), $mixedRule);
        }
        return $mixedRule;
    }

    public function toArray()
    {
        return [ 'name' => $this->getName(), 'description' => $this->getDescription(), 'parameters' => $this->getParameters()
                 , 'mixedRule' => $this->getMixedRule(), 'hasUnlimited' => $this->isUnlimited(), 'actualParameters' => $this->getActualParameters() ];
    }

    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function jsonSerialize()
    {
        return $this->toArray();
    }

    public function offsetExists($offset)
    {
        return property_exists($this, $offset);
    }

    public function offsetGet($offset)
    {
        return $this->{$offset};
    }

    public function offsetSet($offset, $value)
    {
        // TODO: Implement offsetSet() method.
    }

    public function offsetUnset($offset)
    {
        // TODO: Implement offsetUnset() method.
    }
}