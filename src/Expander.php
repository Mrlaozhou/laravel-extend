<?php
namespace Mrlaozhou\Extend;

use Illuminate\Container\Container;

class Expander
{
    /**
     * 获取验证器
     *
     * @return \Mrlaozhou\Extend\Validation\Validator
     * @throws \throwable
     */
    public function validator()
    {
        return app(\Mrlaozhou\Extend\Validation\Validator::class);
    }
}