<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $fillable = ['attribute_type_id','value'];

    public function contact(){
        return $this->belongsTo('App\Contact');
    }

    public function type(){
        return $this->belongsTo('App\AttributeType','attribute_type_id','id');
    }
}
