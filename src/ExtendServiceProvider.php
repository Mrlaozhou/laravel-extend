<?php
namespace Mrlaozhou\Extend;



class ExtendServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerSingletonInstance();
    }

    protected function registerSingletonInstance()
    {
        $this->app->singleton('mrlaozhou.expander', function(){
            return new Expander();
        });
        $this->app->singleton(\Mrlaozhou\Extend\Validation\Validator::class, function () {
            return new Validation\Validator();
        });
    }
}