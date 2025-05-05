<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('userManagementAccess', Auth()->user());

        $queryBuilder = User::all();
        return view('user.index',['data'=>$queryBuilder]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('userManagementAccess', Auth()->user());

        $data = new User();
        $data->name = $request->get('name');
        $data->email = $request->get('email');
        $data->email_verified_at = now();
        $data->password = bcrypt($request->get('password'));
        $data->category = $request->get('category');
        $data->remember_token = Str::random(10);

        $data->save();

        return redirect()->route('users.index')->with('status','Akun dengan nama: '.$data->name.' berhasil dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('userManagementAccess', Auth()->user());

        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->email_verified_at = now();
        $user->password = bcrypt($request->get('password'));
        $user->category = $request->get('category');
        $user->remember_token = Str::random(10);

        $user->save();

        return redirect()->route('users.index')->with('status','Akun dengan nama: '.$user->name.' berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('userManagementAccess', Auth()->user());
        if($user->id == Auth()->user()->id){
            return redirect()->route('users.index')->with('error','Akun tidak dapat dihapus, karena sedang digunakan');
        }
        try{
            $user->delete();
            return redirect()->route('users.index')->with('status','Akun dengan nama: '.$user->name.' telah dihapus');
        }catch(\Exception $e){
            return redirect()->route('users.index')->with('error','Akun tidak dapat dihapus, Pesan Error: '.$e->getMessage());
        }
    }

    public function showDetail(Request $request){
        $data=User::find($_POST['id']);
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('user.show',compact('data'))->render()
        ),200);
    }

    public function showCreate(Request $request){

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('user.create')->render()
        ),200);
    }

    public function showEdit(Request $request){
        $user=User::find($_POST['id']);

        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('user.edit',['user'=>$user])->render()
        ),200);
    }
}
