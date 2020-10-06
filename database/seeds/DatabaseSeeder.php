<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		DB::table('admins')->insert([
            'name' => 'bhakti',
			'username'=>'bhakti',
            'email' => 'bhakti@gmail.com',
            'password' => bcrypt('bhakti'),
        ]);
    }
}
