<?php

namespace App\Http\Controllers;

use App\Contact;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param User $user
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        $latestContacts = $user->contacts()
            ->orderBy('created_at','desc')->take(5)->get();

        $contacts = $user->contacts()
            ->orderBy('name','asc')->get();

        return view('contacts.index',compact('contacts','latestContacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|string',
            'phone'=>'numeric',
        ]);

        $result = Auth::user()->contacts()->create($request->all());

        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        $this->authorize('manage',$contact);

        return view('contacts.show',compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        $this->authorize('manage',$contact);

        return view('contacts.edit',compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $this->authorize('manage',$contact);

        $this->validate($request,[
            'name'=>'required|string',
            'phone'=>'numeric',
        ]);

        $result = $contact->update($request->all());

        return response()->json($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {

        $this->authorize('manage',$contact);

        $result = $contact->delete();

        return response()->json($result);
    }
}
