<x-app-layout>
    <x-slot name="header">KULANICILAR</x-slot>
    <div class="card" x-data="{ open: false }" >
        <div class="card-body">
            <h5 class="card-title">
                <a href="{{route('users.create')}}" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Kulanıcı ekle</a> 
            </h5>
            <table class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th scope="col">Sıra</th>
                        <th scope="col">Ad Soyad</th>
                        <th scope="col">E-Mail</th>
                        <th scope="col">Makale Sayısı</th>
                        <th scope="col">Makale Başlıklarını Göster --
                            <a href="#"  class="btn btn-sm btn-success" @click="open = true">
                                <i class="fa-solid fa-caret-down" x-show="open == false"></i>
                                <i class="fa-solid fa-caret-up" x-show="open == true"></i>
                            </a>
                        </th>
                        <th scope="col">İşlemler</th>
                    </tr>
                </thead>
                <tbody >
                @foreach($users as $user)
                    <tr >
                        <td>{{ $loop->iteration }}</td>
                        <td >
                            @if($user-> profile_photo_path )
                             <img src="{{ asset($user-> profile_photo_path) }}" class="w-12 rounded-pill float-right">
                            @else
                                <img src="{{ $user-> profile_photo_url }}" class="w-12 rounded-pill float-right">
                            @endif
                             <strong>{{ $user->name }}</strong></td>
                        <td>{{ $user->email  }}</td>
                        <td>{{ $user->articles_count  }}</td>
                        <td >Kullanıcı Makalelerini gör --
                            <a href="{{route('articles.index',$user->id)}}" class="btn btn-sm btn-warning">
                                <i class="fa fa-question"></i>
                        </td>
                        <td> 
                            <a href="{{route('users.edit',$user->id)}}" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                            <a href="{{route('users.destroy',$user->id)}}" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                        </td>
                    </tr>
                
            {{--  --}}
                <tr @click.outside="open = false" x-show="open">
                    <td colspan="6">
                        <div class="card">
                            <div class="card-body">
                                <table class="table table-bordered mb-2">
                                    <thead>
                                        <tr>
                                            <th scope="col">Sıra</th>
                                            <th scope="col">Kulanıcı Makale Başlıkları</th>
                                            {{-- <th scope="col">İşlemler</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>     
                                        <tr>                   
                                        @foreach($user->articles as $article)
                                            <td >{{ $loop->iteration }}</td>
                                            <td >{{ $article->title }}</td>
                                            <td >{{mb_strimwidth( $article->article , 0, 50, "...")}}</td>
                                            
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                         </div>
                    </td>
                </tr>
         {{--  --}}
                 @endforeach
                </tbody>
            </table>
            {{$users->links()}}
        </div>
    </div>
</x-app-layout>
