<?php
/**
 * Created by PhpStorm.
 * User: sagar
 * Date: 7/2/15
 * Time: 9:07 PM
 */
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Feedback extends Eloquent implements UserInterface, RemindableInterface {

    use UserTrait, RemindableTrait;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customer_feedbacks';
    /*
    -By default laraval consider primary key name is 'id'
    -To change My Default Primary key name

    */
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

}