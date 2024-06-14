<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class movieapp extends Model
{
    protected $table ='movieapp';

    protected $fillable = [
                            'nama',
                            'gender',
                            'year',
                            'photo'
                          ];
}
