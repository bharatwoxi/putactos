<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 29/12/14
 * Time: 10:43 PM
 */
class CupSizeSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cup_size_master')->delete(); // deleting old records.
        DB::table('cup_size_master')->insert(array(
            array('cup_size' => 'A','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('cup_size' => 'B','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('cup_size' => 'C','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('cup_size' => 'D','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('cup_size' => 'E','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('cup_size' => 'AA','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('cup_size' => 'BB','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('cup_size' => 'CC','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('cup_size' => 'DD','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('cup_size' => 'EE','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),

        ));
    }
}