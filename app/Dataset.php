<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dataset extends Model 
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'original_name', 'unique_name', 'size', 'columns', 'rows'
    ];
}
