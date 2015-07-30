<?php namespace October\Test\Models;

use Model;

/**
 * Phone Model
 */
class Phone extends Model
{


    /**
     * @var string The database table used by the model.
     */
    public $table = 'october_test_phones';

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
    public $belongsTo = [
        'person' => ['October\Test\Models\Person']
    ];

    public $attachOne = [
        'picture' => ['System\Models\File']
    ];

    public function getBrandOptions()
    {
        return [
            'nokia'  => 'Nokia',
            'apple'  => 'Apple',
            'samsung' => 'Samsung',
        ];
    }

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }

}