<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Clipfile extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'clipfile';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'file_location', 'file_url', 'file_size', 'file_mimetype'];
}