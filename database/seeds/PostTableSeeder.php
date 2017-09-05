<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Core\Entities\Bp_post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bp_post::truncate();
        $this->faker = \Faker\Factory::create();

        for ($i=0; $i < 10; $i++) {
            $Bp_post = [
                'title'         => $post = $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                'body'          => $this->faker->text,
                'post_link'     => str_replace(' ', '-', strtolower($post)),
                'post_type'     => 'post',
                'featured_img'  => 'default.jpg',
                'staff_id'      => 1,
                'created_at'    => '2016-06-3 00:36:29'

            ];
            Bp_post::insert($Bp_post);
        }

        for ($y=0; $y < 5; $y++) {
            $Bp_post = [
                'title'         => $page = $this->faker->sentence($nbWords = 6, $variableNbWords = true),
                'body'          => $this->faker->text,
                'post_link'     => str_replace(' ', '-', strtolower($page)),
                'post_type'     => 'page',
                'featured_img'  => 'default.jpg',
                'staff_id'      => 1,
                'created_at'    => '2016-06-3 00:36:29'
            ];
            Bp_post::insert($Bp_post);
        }
    }
}
