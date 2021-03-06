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
        if($request->hasFile('profile_photo_path')){
                        $fileName = Str::slug($request->name).'.'.$request->profile_photo_path->extension();
                        $fileNameWithUload = "storage/profile-photos/".$fileName;
                        $request->profile_photo_path->move(public_path('storage/profile-photos'),$fileName);
                        $request->merge([
                            User::create( [
                                'profile_photo_path'=>$fileNameWithUload,
                                'name' => $request->name,
                                'email' => $request->email,
                                'password' => bcrypt($request->password),
                            ] )
                        ]);
                        
                      }
                    else {
                    User::create(['name' => $request->name,
                                'email' => $request->email,
                                'password' => bcrypt($request->password)]);
                }
            return redirect()->route('users.index')->withSuccess('Kullan??c?? Ba??ar??yla Olu??turuldu');      
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
        $user = User::find($id) ?? abort(404,"Kulan??c?? Bulunamad??");
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
        $user = User::find($id) ?? abort(404,"Kulan??c?? Bulunamad??");
        if($request->hasFile('profile_photo_path')){
                        $fileName = Str::slug($request->name).'.'.$request->profile_photo_path->extension();
                        $fileNameWithUload = "storage/profile-photos/".$fileName;
                        $request->profile_photo_path->move(public_path('storage/profile-photos'),$fileName);
                        $request->merge([
                            User::where('id',$id)->update( ['profile_photo_path'=>$fileNameWithUload] )
                        ]);
                        
                      }
                      
        User::where('id',$id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => bcrypt($request->password),
                    ]);
                           
        return redirect()->route('users.index')->withSuccess('Kulan??c?? G??ncelleme i??lemi ba??ar??yla ger??ekle??ti');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id) ?? abort(404,"Kulan??c?? Bulunamad??");
        $user->delete();
        return redirect()->route('users.index')->withSuccess('Kulan??c?? Silme i??lemi ba??ar??yla ger??ekle??ti');
    }
}
