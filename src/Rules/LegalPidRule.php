<?php
namespace Mrlaozhou\Extend\Rules;

use Illuminate\Contracts\Validation\Rule;
use Mrlaozhou\Extend\Collection;

class LegalPidRule implements Rule
{

    /**
     * @var \Mrlaozhou\Extend\Collection
     */
    protected $collection;

    /**
     * @var int|null
     */
    protected $originId;

    /**
     * LegalPid constructor.
     *
     * @param \Mrlaozhou\Extend\Collection $collection
     * @param int|null                     $originIdId
     */
    public function __construct(Collection $collection,int $originIdId = null)
    {
        //
        $this->collection       =   $collection;
        //
        $this->originId         =   $originIdId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //  顶级
        if( $value == 0 ) return true;
        //  是否存在
        if( ! $this->collection->keyBy('id')->get( $value, false ) )
            return false;
        //
        if( ! is_null($this->originId) )
            return $this->checkUpdate($value);
        return $this->checkCreate($value);
    }

    protected function checkCreate ($value)
    {
        return true;
    }

    protected function checkUpdate ($value)
    {
        return ! $this->collection
            ->toLists( $this->originId )
            ->pluck('id')
            ->push($this->originId)->contains($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Param [:attribute] is not a legal pid.';
    }
}
