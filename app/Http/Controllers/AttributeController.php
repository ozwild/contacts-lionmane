<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;
use App\Attribute;
use App\AttributeType;

class AttributeController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = AttributeType::orderBy('name','asc')->get();

        return view('attributes.create', compact('types'));
    }

    /**
     * @param Request $request
     * @param Contact $contact
     * @return array|void
     */
    public function store(Request $request, Contact $contact){

        if(!$request->has('attributes')){
            return;
        }

        $payload = collect($request->get('attributes',[]));

        $typeIds = collect($payload)->map(function($attribute){
            return $attribute['attribute_type_id'];
        });

        $rules = AttributeType::whereIn('id',$typeIds)->get()->reduce(function($carry, $type){
            $carry[$type->name] = $type->validation_pattern;
            return $carry;
        },[]);

        $this->validate($request,$rules);

        $contact->attributes()->delete();



        return $payload->map(function($attribute) use ($contact){
            return $contact->attributes()->create($attribute);
        });
    }
}
