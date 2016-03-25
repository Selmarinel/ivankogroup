<?php
namespace App\Modules\SelmarinelCore\Providers;

class Module {

	protected $modulePath = '';

	/**
	 * Module constructor.
	 * @param string $modulePath
	 */
	public function __construct($modulePath) {
		$this->modulePath = $modulePath;
	}

	public function getPath($path = '') {
		$url = '/' . $this->modulePath;
		$url .= ($path) ? $path : '';
		return \URL::asset($url);
	}
}
