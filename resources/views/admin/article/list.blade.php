<x-app-layout>
    <x-slot name="header">{{$user->name}} Kulanıcısına Ait Makaleler</x-slot>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('users.index')}}" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i> Kulanıcılar Tablosuna Dön</a> 
            </h5>
            <table class="table table-bordered table-sm">
                <thead>
                    <tr>
                        <th scope="col">Başlık</th>
                        <th scope="col">Makale</th>
                        <th scope="col">Fotoğraf</th>
                        <th scope="col">İşlemler</th>
                    </tr>
                    
                </thead>
                <tbody>
                    @foreach($user->articles as $article)
                    <tr>
                        <td>{{ $article->title }}</td>
                        <td>{{ $article->article }}</td>
                        <td>
                            @if($article->image )
                            <a href="{{ asset($article->image) }}" target="_blank" class="btn btn-sm btn-success">Görüntüle</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{route('articles.destroy',[$user->id,$article->id])}}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>