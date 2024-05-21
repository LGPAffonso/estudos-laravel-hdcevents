<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    //para "forçar" um tipo de dado ao banco
    protected $casts = [
        'itens'=> 'array'
    ];
    protected $dates = ['data'];
    protected $guarded = [];

    public function user(){
        return $this->belongsTo("\App\Models\User");
    }

    public function users(){
        return $this->belongsToMany("\App\Models\User");

    }

}
