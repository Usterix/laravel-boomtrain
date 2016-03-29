<?php namespace Usterix\LaravelBoomtrain;

use Illuminate\Support\Facades\Facade;

class BoomtrainFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'boomtrain';
    }
}
