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
          $this->call('TaxTableSeeder');
          $this->call('MenuTableSeeder');
          $this->call('ModuleTableSeeder');
          $this->call('LanguageTableSeeder');
    }
}
