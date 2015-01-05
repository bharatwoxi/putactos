<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 29/12/14
 * Time: 10:32 PM
 */
class EyeColorSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('eye_color_master')->delete(); // deleting old records.
        DB::table('eye_color_master')->insert(array(
            array('eye_color' => 'BLACK','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('eye_color' => 'BROWN','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('eye_color' => 'BLUE','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('eye_color' => 'GREEN','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('eye_color' => 'GREY','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
        ));
    }

}