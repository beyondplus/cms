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
          $this->call('UserTableSeeder');
          $this->call('PostTableSeeder');
          $this->call('OptionsTableSeeder');
          $this->call('CategoryTableSeeder');
          $this->call('MenuTableSeeder');
          $this->call('ModuleTableSeeder');
          $this->call('LanguageTableSeeder');
    }
}
