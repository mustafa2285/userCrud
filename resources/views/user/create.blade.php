<x-app-layout>
    <x-slot name="header">{{$user->name}} Yeni Makale Oluştur</x-slot>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{route('article.store',$user->id)}}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Makale Başlığı</label>
                <input type="text" name="title" class="form-control" value={{old('title')}}>
            </div>
            <div class="form-group">
                <label>Fotoğraf</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="form-group">
                <label>Makale</label>
                <textarea name="article" class="form-control" rows="4">{{old('article')}}</textarea>
            </div>
            <div class="form-group mt-3">
                <button type="submit"class="btn btn-success btn-sm w-100">Yeni Makale Oluştur</button>
            </div>
            </form>
        </div>
    </div>
   
</x-app-layout>