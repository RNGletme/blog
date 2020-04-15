<?php

use Illuminate\Database\Seeder;

class BlogKindSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\BlogKind::create(
        	['name'=>'PHP日记', 'user_id'=>1]
        );
    }
}
