<?php
namespace Mrlaozhou\Extend\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @desc 扩展器
 *
 * Class Expand
 *
 * @package Mrlaozhou\Extend\Facades
 * @method static \Mrlaozhou\Extend\Validation\Validator validator()
 */
class Expand extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'mrlaozhou.expander';
    }
}