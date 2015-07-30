<?php namespace October\Test\Models;

use Model;

/**
 * Person Model
 */
class Person extends Model
{


    /**
     * @var string The database table used by the model.
     */
    public $table = 'october_test_people';

    /**
     * @var array Guarded fields
     */
    protected $guarded = [];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];


    /**
     * @var array Relations
     */
    public $hasOne = [
        'phone' => ['October\Test\Models\Phone', 'key' => 'person_id', 'scope' => 'isActive'],
        'alt_phone' => ['October\Test\Models\Phone', 'key' => 'person_id']
    ];

}