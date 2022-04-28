<?php

namespace Zl\Luosimao;

use Illuminate\Support\ServiceProvider;

class LuosimaoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // 发布配置文件
        $this->publishes([
            __DIR__ . '/config/sms.php' => config_path('sms.php'),
        ]);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton('luosimao.sms', function ($app) {
            return new LuosimaoSms($app['config']);
        });
    }
}
