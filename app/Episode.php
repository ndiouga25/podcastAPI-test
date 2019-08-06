<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    //
    protected $fillable = ['url', 'title', 'description', 'numepisode', 'datecreate', 'dateupdate'];
}
