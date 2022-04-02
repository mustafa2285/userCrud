<x-app-layout>
    <x-slot name="header">{{$article->title}} Düzenle</x-slot>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('article.update',[$article->user_id,$article->id])}}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Makale Başlığı</label>
                <input type="text" name="title" class="form-control" value={{$article->title}}>
            </div>
            <div class="form-group">
                <label>Fotoğraf</label>
                @if($article->image)
                <a href="{{asset($article->image)}}" target="_blank">
                    <img src="{{asset($article->image)}}" class="img-responsive" style="width: 200px">
                </a>
                @endif
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Makale</label>
                <textarea name="article" class="form-control" rows="4">{{$article->article}}</textarea>
            </div>
            <div class="form-group mt-3">
                <button type="submit"class="btn btn-success btn-sm w-100">Makaleyi Düzenle</button>
            </div>
            </form>
        </div>
    </div>
   
</x-app-layout>