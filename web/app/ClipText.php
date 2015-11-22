<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliptext extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cliptext';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'text-content', 'html-content'];

}

