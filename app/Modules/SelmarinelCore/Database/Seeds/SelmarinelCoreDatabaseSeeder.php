<?php
namespace App\Modules\SelmarinelCore\Database\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class SelmarinelCoreDatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('App\Modules\SelmarinelCore\Database\Seeds\FoobarTableSeeder');
	}

}
