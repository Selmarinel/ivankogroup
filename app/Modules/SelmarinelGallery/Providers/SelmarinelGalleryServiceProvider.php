<?php
namespace App\Modules\SelmarinelGallery\Providers;

use App;
use Config;
use Lang;
use View;
use Illuminate\Support\ServiceProvider;

class SelmarinelGalleryServiceProvider extends ServiceProvider
{
	/**
	 * Register the SelmarinelGallery module service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// This service provider is a convenient place to register your modules
		// services in the IoC container. If you wish, you may make additional
		// methods or service providers to keep the code more focused and granular.
		App::register('App\Modules\SelmarinelGallery\Providers\RouteServiceProvider');

		$this->registerNamespaces();
	}

	/**
	 * Register the SelmarinelGallery module resource namespaces.
	 *
	 * @return void
	 */
	protected function registerNamespaces()
	{
		Lang::addNamespace('selmarinel_gallery', realpath(__DIR__.'/../Resources/Lang'));

		View::addNamespace('selmarinel_gallery', base_path('resources/views/vendor/selmarinel_gallery'));
		View::addNamespace('selmarinel_gallery', realpath(__DIR__.'/../Resources/Views'));
	}
}
