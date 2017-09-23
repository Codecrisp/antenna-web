<?php

namespace App\Providers;

use Mail;
use App\User;
use App\Events\UserRegistered;
use App\Pigeons\Registrars\Duifmelden;
use App\Pigeons\Registrars\Registrar;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		User::created(function($user){
            event(new UserRegistered($user));
		});

        \View::composer('pages.dashboard.*', function($view){
			$view->with('currentUser', \Auth::user());
		});

		$this->app->bind(Registrar::class, Duifmelden::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
