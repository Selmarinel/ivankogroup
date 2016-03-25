<?php
namespace App\Modules\SelmarinelAdmin\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SelmarinelAdminServiceProvider extends ServiceProvider
{
	/**
	 * Register the SelmarinelAdmin module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\SelmarinelAdmin\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the SelmarinelAdmin module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('selmarinel_admin', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('selmarinel_admin', base_path('resources/views/vendor/selmarinel_admin'));
		View::addNamespace('selmarinel_admin', realpath(__DIR__.'/../Resources/Views'));
	}
}
