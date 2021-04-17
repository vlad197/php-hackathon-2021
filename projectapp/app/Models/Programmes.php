<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Programmes extends Model{

    public $table = 'programmes';
    protected $fillable = [
        'startingdate',
        'endingdate',
        'participants',
        'room'
    ];





}
