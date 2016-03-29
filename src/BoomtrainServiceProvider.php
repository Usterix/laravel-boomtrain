<?php
namespace Usterix\LaravelBoomtrain;

use Illuminate\Support\ServiceProvider;

class BoomtrainServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Usterix\LaravelBoomtrain\Boomtrain', function ($app) {

            $boomtrain = new Boomtrain();

            return $boomtrain;
        });
        $this->app->alias('Usterix\LaravelBoomtrain\Boomtrain','boomtrain');
    }


}
