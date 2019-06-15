<?php
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = array('Marry','Alex','Curtis','Smith','John');
    	for ($i = 0; $i < 5; $i++) {
	     	DB::table('users')->insert([
	            'name' => $name[$i],
	            'email' => strtolower($name[$i]).'@gmail.com',
	            'password' => bcrypt('secret'),
	        ]);
    	}
    }
}
