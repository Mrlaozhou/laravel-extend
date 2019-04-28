<?php
namespace Mrlaozhou\Extend;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use Mrlaozhou\Extend\Exceptions\ExtensionNotLoadedException;

class ServiceProvider extends BaseServiceProvider
{
    public function boot () {}

    public function register () {}

    /**
     * 检测是否安装php扩展
     *
     * @param string $extensionName
     *
     * @throws \throwable
     */
    protected function is_extension_loaded($extensionName)
    {
        if( ! extension_loaded($extensionName) ) {
            throw new ExtensionNotLoadedException($extensionName);
        }
    }
}