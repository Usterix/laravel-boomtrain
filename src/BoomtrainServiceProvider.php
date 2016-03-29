<?php
namespace Usterix\Boomtrain;

use Illuminate\Support\ServiceProvider;

class BoomtrainServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('Usterix\Boomtrain\Boomtrain', function ($app) {

            $boomtrain = Boomtrain::init();

            return $boomtrain;
        });
    }


}
