<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('admin');

    }

    public function index()
    {
        $users = User::all();

    return view('users.index', [
        'users' => $users,

    ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required',
        ]);
        $array = $request->only([
            'name', 'email', 'password', 'role',
        ]);
        $array['password'] = bcrypt($array['password']);
        $user = User::create($array);

        return redirect()->route('users.index')
            ->with('success_message', 'Berhasil menambah user baru');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
    if (! $user) {
    return redirect()->route('users.index')
        ->with('error_message', 'User dengan id'.$id.' tidak ditemukan');
    }

    return view('users.edit', [
        'user' => $user,
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'sometimes|nullable|confirmed',
            'role' => 'required',
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
        $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->save();

        return redirect()->route('users.index')
            ->with('success_message', 'Berhasil mengubah user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
    if ($id == $request->user()->id) {
    return redirect()->route('users.index')
        ->with('error_message', 'Anda tidak dapat menghapus diri sendiri.');
    }
    if ($user) {
    $user->delete();
    }

    return redirect()->route('users.index')
        ->with('success_message', 'Berhasil menghapus user');
    }
}
