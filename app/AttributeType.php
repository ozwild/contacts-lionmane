<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttributeType extends Model
{
    protected $fillable = ['name','html_attributes','validation_pattern','icon'];

    public function attributes(){
        return $this->hasMany('App\Attribute','attribute_type_id','id');
    }
}
