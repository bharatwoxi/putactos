<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 29/12/14
 * Time: 10:43 PM
 */
class WeekDaySeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('week_day_master')->delete(); // deleting old records.
        DB::table('week_day_master')->insert(array(
            array('week_day' => 'MONDAY','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('week_day' => 'TUESDAY','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('week_day' => 'WEDNESDAY','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('week_day' => 'THURSDAY','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('week_day' => 'FRIDAY','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('week_day' => 'SATURDAY','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),
            array('week_day' => 'SUNDAY','created_at'=>date('Y-m-d H:i:s'),'updated_at' =>date('Y-m-d H:i:s')),

        ));
    }
}