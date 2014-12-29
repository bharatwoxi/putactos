<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 29/12/14
 * Time: 10:35 PM
 */
class HairColorSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('hair_color_master')->delete(); // deleting old records.
        DB::table('hair_color_master')->insert(array(
            array('hair_color' => 'BLACK','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('hair_color' => 'BROWN','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('hair_color' => 'WHITE','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
        ));
    }
}