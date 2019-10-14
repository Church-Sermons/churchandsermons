<?php

namespace App\Http\Controllers\Profile;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Profile;
use App\Traits\ContactTrait;
use Session;

class ProfileContactController extends Controller
{
    use ContactTrait;

    protected $name;

    public function __construct()
    {
        $except = ['store', 'create'];
        $this->middleware('auth')->except($except);
        $this->middleware('role:admin|superadmin|author')->except($except);

        $this->name = 'profiles';
    }

    public function index($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('contacts.index', compact('model'))->withName($this->name);
    }

    public function create($uuid)
    {
        $model = Profile::getByUuid($uuid);

        return view('contacts.create', compact('model'))->withName($this->name);
    }

    public function store(StoreContactRequest $request, $uuid)
    {
        $response = $this->storeContacts($uuid, $request);

        if ($response['contact']->save()) {
            Session::flash('success', 'Message sent successfully');

            return redirect()->route('profiles.show', $uuid);
        } else {
            return redirect()
                ->back()
                ->withErrors($response['validator'])
                ->withInput();
        }
    }

    public function destroy($uuid, $id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact->delete()) {
            Session::flash('success', 'Message deleted');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Message failed to delete');

            return redirect()->back();
        }
    }
}
