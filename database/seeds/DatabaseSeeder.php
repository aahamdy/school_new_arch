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
        $this->call(SectionsAppSeeder::class);
    }
}

class SectionsAppSeeder extends Seeder
{

    public function run()
    {

        // clear our database ------------------------------------------
        DB::table('section_subjects')->delete();
        DB::table('sections')->delete();
        DB::table('subjects')->delete();
    }
}