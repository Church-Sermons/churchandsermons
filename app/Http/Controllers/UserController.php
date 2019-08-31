<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Session;
use Hash;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);
        return view('manage.users.index')->withUsers($users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('manage.users.create')->withRoles($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users'
        ]);

        if($request->has('password') && !empty($request->password)){
            $password = trim($request->password);
        }else{
            // set manual password
            $length = 10;
            $keyspace = '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
            $str = '';
            $max = mb_strlen($keyspace, '8bit') - 1;
            for($i = 0; $i < $length; ++$i){
                $str .= $keyspace[random_int(0, $max)];
            }
            $password = $str;
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($password);

        $user->save();

        if($request->roles){
            $user->syncRoles(explode(',', $request->roles));
        }

        return redirect()->route('users.show', $user->id);
        // if(){
        //
        // }else{
        //     Session::flash('danger', 'Error! User could not be created');
        //     return redirect()->route('users.create');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->with('roles')->first();

        return view('manage.users.show')->withUser($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id',$id)->with('roles')->first();
        $roles = Role::all();
        return view('manage.users.edit')->withUser($user)->withRoles($roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,'.$id
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->password_options == 'auto'){
             // set manual password
             $length = 10;
             $keyspace = '123456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ';
             $str = '';
             $max = mb_strlen($keyspace, '8bit') - 1;
             for($i = 0; $i < $length; ++$i){
                 $str .= $keyspace[random_int(0, $max)];
             }
             $user->password = $str;
        }else if($request->password_options == 'manual'){
            $user->password = Hash::make($request->password);
        }

        $user->save();

        if($request->roles){
            $user->syncRoles(explode(',', $request->roles));
        }

        return redirect()->route('users.show', $id);
        // if($user->save()){
        //     return redirect()->route('users.show', $user->id);
        // }else{
        //     Session::flash('danger', 'Error! User could not be updated');
        //     return redirect()->route('users.edit');
        // }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
