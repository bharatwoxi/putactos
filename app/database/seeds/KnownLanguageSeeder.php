<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 1/12/14
 * Time: 2:16 PM
 */
class KnownLanguageSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('known_languages')->insert(array(
            array('language_name' => 'ENGLISH','created_at'=>date('Y-m-d H:m:s'),'updated_at' =>date('Y-m-d H:m:s')),
            array('language_name' => 'SPANISH','created_at'=>date('Y-m-d H:m:s'),'updated_at' =>date('Y-m-d H:m:s')),
        ));
    }

}