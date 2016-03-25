<?php
namespace App\Modules\SelmarinelCore\Providers;

use Caffeinated\Modules\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Routing\Router;

class RouteServiceProvider extends ServiceProvider
{
	protected $moduleName = 'SelmarinelCore';
	protected $assetsPath = 'assets/SelmarinelCore/';
	/**
	 * This namespace is applied to the controller routes in your module's routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Modules\SelmarinelCore\Http\Controllers';

	/**
	 * Define your module's route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		$this->initAssets();
		parent::boot($router);

		//
	}

	protected function initAssets(){
		$this->publishes([
			__DIR__.'/../Resources/Assets' => public_path($this->assetsPath),
		], $this->moduleName);

		$this->app->bind('SelmarinelCore.assets', function() {
			return new Module($this->assetsPath);
		});
	}

	/**
	 * Define the routes for the module.
	 *
	 * @param  \Illuminate\Routing\Router $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require (config('modules.path').'/SelmarinelCore/Http/routes.php');
		});
	}
}
