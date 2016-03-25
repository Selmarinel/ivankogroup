<?php
namespace App\Modules\SelmarinelAdmin\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SelmarinelAdminDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\SelmarinelAdmin\Database\Seeds\FoobarTableSeeder');
	}

}
