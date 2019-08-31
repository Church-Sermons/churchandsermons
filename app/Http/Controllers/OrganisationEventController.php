<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Session;
use Auth;
class OrganisationEventController extends Controller
{
    /**
     *
     * Organisation Event Index
     */

     public function index($id)
     {
         $events = Event::where('org_id', $id)->orderBy('id', 'desc')->paginate(10);
         return view('organisations.events.index')->withEvents($events);
     }


     /**
      *
      * Organisation Event Create
      */

      public function create($id)
      {

      }

      /**
      *
      * Organisation Event Store
      */

      public function store(Request $request, $id)
      {

      }

      /**
      *
      * Organisation Event show
      */

      public function show($org_id, $id)
      {

      }

      /**
      *
      * Organisation Event update
      */

      public function edit($org_id, $id)
      {

      }

      /**
      *
      * Organisation Event Show
      */

      public function update(Request $request, $org_id, $id)
      {

      }

      /**
      *
      * Organisation Event delete
      */

      public function destroy($org_id, $id)
      {

      }

}
