<?php

use Illuminate\Database\Eloquent\Model;

class Room extends Model {


    public $table = 'rooms';


    public function programmes()
    {
        return $this->hasMany(\App\Models\Programmes::class);
    }


}
