<?php
namespace App\Modules\SelmarinelCore\Providers;

use App;
use Config;
use Lang;
use View;
use App\Modules\SelmarinelCore\Providers\Module;
use Illuminate\Support\ServiceProvider;

class SelmarinelCoreServiceProvider extends ServiceProvider
{
	/**
	 * Register the SelmarinelCore module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\SelmarinelCore\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the SelmarinelCore module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('SelmarinelCore', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('SelmarinelCore', base_path('resources/views/vendor/SelmarinelCore'));
		View::addNamespace('SelmarinelCore', realpath(__DIR__.'/../Resources/Views'));
	}
}
