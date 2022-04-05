<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::withCount('articles')->paginate(5);
        return view('admin.list',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        // User::where('password',md5($request->password));
        User::create(['name' => $request->name,
                      'email' => $request->email,
                      'password' => md5($request->password)]);
        return redirect()->route('users.index')->withSuccess('Kullanıcı Başarıyla Oluşturuldu');
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
        $user = User::find($id) ?? abort(404,"Kulanıcı Bulunamadı");
        return view('admin.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $user = User::find($id) ?? abort(404,"Kulanıcı Bulunamadı");
        User::where('id',$id)->update(['name' => $request->name,
                      'email' => $request->email,
                      'password' => md5($request->password)]);
        return redirect()->route('users.index')->withSuccess('Kulanıcı Güncelleme işlemi başarıyla gerçekleşti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id) ?? abort(404,"Kulanıcı Bulunamadı");
        $user->delete();
        return redirect()->route('users.index')->withSuccess('Kulanıcı Silme işlemi başarıyla gerçekleşti');
    }
}
