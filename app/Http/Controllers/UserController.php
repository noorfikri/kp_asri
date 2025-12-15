<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\FileUploadService;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
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
        $this->authorize('userManagementAccess', auth()->user());
        $users = User::all();
        return view('user.index', ['data' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->authorize('userManagementAccess', auth()->user());

        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'contact_number' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'category' => 'required|in:staff,owner',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user = new User();
            $user->name = request('name');
            $user->email = request('email');
            $user->contact_number = request('contact_number');
            $user->address = request('address');
            $user->password = bcrypt(request('password'));
            $user->category = request('category');
            $user->remember_token = Str::random(10);

            if (request()->hasFile('image')) {
                $user->profile_picture = App::call([new FileUploadService, 'uploadFile'], [
                    'file' => request()->file('image'),
                    'filename' => $user->name,
                    'folder' => 'user'
                ]);
            }

            $user->save();

            return redirect()->route('users.index')->with('status', 'Akun dengan nama: ' . $user->name . ' berhasil dibuat');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Gagal membuat akun: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(User $user)
    {
        $this->authorize('userManagementAccess', auth()->user());

        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'contact_number' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'category' => 'required|in:staff,owner',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.index')
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $user->name = request('name');
            $user->email = request('email');
            $user->contact_number = request('contact_number');
            $user->address = request('address');
            if (request('password')) {
                $user->password = bcrypt(request('password'));
            }
            $user->category = request('category');

            if (request()->hasFile('image')) {
                $user->profile_picture = App::call([new FileUploadService, 'uploadFile'], [
                    'file' => request()->file('image'),
                    'filename' => $user->name,
                    'folder' => 'user'
                ]);
            }

            $user->save();

            return redirect()->route('users.index')->with('status', 'Akun dengan nama: ' . $user->name . ' berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->route('users.index')->with('error', 'Gagal memperbarui akun: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('userManagementAccess', auth()->user());
        if ($user->id == auth()->user()->id) {
            return redirect()->route('users.index')->with('error', 'Akun tidak dapat dihapus, karena sedang digunakan');
        }
        try {
            $user->delete();
            return redirect()->route('users.index')->with('status', 'Akun dengan nama: ' . $user->name . ' telah dihapus');
        } catch (QueryException $e) {
            if ($e->getCode() == 23000) {
                return redirect()->route('users.index')->with('error', 'Maaf anda tidak dapat menghapus akun ' . $user->name . ' karena telah digunakan di transaksi penjualan atau laporan');
            }
            return redirect()->route('users.index')->with('error', 'Akun tidak dapat dihapus, Pesan Error: ' . $e->getMessage());
        }
    }

    public function showDetail()
    {
        $data = User::find(request('id'));
        return response()->json([
            'status' => 'ok',
            'msg' => view('user.show', compact('data'))->render()
        ], 200);
    }

    public function showCreate()
    {
        return response()->json([
            'status' => 'ok',
            'msg' => view('user.create')->render()
        ], 200);
    }

    public function showEdit()
    {
        $user = User::find(request('id'));
        return response()->json([
            'status' => 'ok',
            'msg' => view('user.edit', ['user' => $user])->render()
        ], 200);
    }

    public function updateProfile(User $user)
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'contact_number' => 'required|string|max:50',
            'address' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->to('admin/profile')
                ->withErrors($validator)
                ->withInput();
        }

        $user->name = request('name');
        $user->email = request('email');
        $user->contact_number = request('contact_number');
        $user->address = request('address');

        if (request()->hasFile('image')) {
            $user->profile_picture = App::call([new FileUploadService, 'uploadFile'], [
                'file' => request()->file('image'),
                'filename' => $user->name,
                'folder' => 'user'
            ]);
        }

        $user->save();

        return redirect()->to('admin/profile')->with('status', 'Akun anda berhasil diperbarui');
    }
}
