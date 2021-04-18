<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Programmes extends Model{

    public $table = 'programmes';
    protected $fillable = [
        'name',
        'startingdate',
        'endingdate',
        'participants',
        'room',
        'user_id'
    ];





}
