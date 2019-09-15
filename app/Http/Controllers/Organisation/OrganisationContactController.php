<?php

namespace App\Http\Controllers\Organisation;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Organisation;
use App\Traits\ContactTrait;
use Session;

class OrganisationContactController extends Controller
{
    use ContactTrait;

    protected $name;

    public function __construct()
    {
        $except = ['store', 'create'];
        $this->middleware('auth')->except($except);
        $this->middleware('role:admin|superadmin|author')->except($except);

        $this->name = 'organisations';
    }

    public function index($uuid)
    {
        $model = Organisation::getByUuid($uuid);

        return view('contacts.index', compact('model'));
    }

    public function create($uuid)
    {
        $model = Organisation::getByUuid($uuid);

        return view('contacts.create', compact('model'))->withName($this->name);
    }

    public function store(StoreContactRequest $request, $uuid)
    {
        $response = $this->storeContacts($uuid, $request);

        if ($response['contact']->save()) {
            Session::flash('success', 'Message sent successfully');
            return redirect()->route('organisations.show', $uuid);
        } else {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors($response['validator']);
        }
    }

    public function destroy($uuid, $id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact->delete()) {
            Session::flash('success', 'Message deleted successfully');

            return redirect()->back();
        } else {
            Session::flash('danger', 'Message not deleted');

            return redirect()->back();
        }
    }
}
