<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
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
        $id = Auth::user()->id;
        $user = User::whereId($id)->with('articles')->first() ?? abort(404,"Makale  Bulunamadı");
        return view('user.list', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('user.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCreateRequest $request)
    {
        $id = Auth::user()->id;
        if($request->hasFile('image')){
            $fileName = Str::slug($request->title).'.'.$request->image->extension();
            $fileNameWithUload = "uploads/".$fileName;
            $request->image->move(public_path('uploads'),$fileName);
            $request->merge([
                'image' =>$fileNameWithUload
            ]) ;
        }
        User::find($id)->articles()->create($request->post());
        return  redirect()->route('article.index',$id)->withSuccess('Makale başarıyla oluşturuldu');
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
     * @param  int  $id ***  *** ->articles()->whereId($article_id)->first() ?? abort(404,"Quiz veya Soru Bulunamadı")
     * @return \Illuminate\Http\Response
     */
    public function edit($id,$article_id)
    {
        $user_id = Auth::user()->id;
        $article = User::find($user_id)->articles()->whereId($article_id)->first() ?? abort(404,"Makale veya Soru Bulunamadı");
        return view('user.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ArticleUpdateRequest $request, $id,$article_id)
    {
        $user_id = Auth::user()->id;
        if($request->hasFile('image')){
            $fileName = Str::slug($request->title).'.'.$request->image->extension();
            $fileNameWithUload = "uploads/".$fileName;
            $request->image->move(public_path('uploads'),$fileName);
            $request->merge([
                'image' =>$fileNameWithUload
            ]) ;
        }
        User::find($user_id)->articles()->whereId($article_id)->first()->update($request->post());
        return redirect()->route('article.index',$id)->withSuccess('Makale başarıyla Güncellendi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id,$article_id)
    {
        $user_id = Auth::user()->id;
        User::find($user_id)->articles()->whereId($article_id)->delete();
        return  redirect()->route('article.index',$user_id)->withSuccess('Makale başarıyla silindi');
    }
}
