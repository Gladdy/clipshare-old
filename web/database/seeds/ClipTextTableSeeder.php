<?php

use Illuminate\Database\Seeder;
use App\Cliptext;

class CliptextTableSeeder extends Seeder {

    public function run()
    {
        DB::table('cliptext')->delete();

        for($i = 0; $i < 10; $i++) {

            ClipText::create(array(
                'user_id' => 1,
                'text_content' => 'Hello world to '.$i.'!',
                'html_content' => '<html><p>Hello world to '.$i.'!</p></html>'
            ));

        }
    }
}