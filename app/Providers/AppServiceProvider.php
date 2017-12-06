<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Form;

class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
    public function boot()
    {
    	Form::macro('labelWithHTML', function ($name, $html) {
		    return '<label for="'.$name.'">'.$html.'</label>';
		});

        app('view')->composer(array('home','layout','full-content','case-profile'), function($view)
        {
            $action = app('request')->route()->getAction();

            //$controller = strtolower(class_basename($action['controller']));
            $controller = str_replace('controller','',strtolower(class_basename($action['controller'])));

            list($controller, $action) = explode('@', $controller);

            $view->with(compact('controller', 'action'));
        });
    }

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
