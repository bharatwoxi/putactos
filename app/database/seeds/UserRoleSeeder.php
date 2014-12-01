<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 1/12/14
 * Time: 2:09 PM
 */

class UserRoleSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_role')->insert(array(
            array('role' => 'CUSTOMER','created_at'=>date('Y-m-d H:m:s'),'updated_at' => date('Y-m-d H:m:s')),
            array('role' => 'SERVICE PROVIDER','created_at'=>date('Y-m-d H:m:s'),'updated_at' =>date('Y-m-d H:m:s')),
        ));
    }

}