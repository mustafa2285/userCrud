

<x-app-layout>
    <x-slot name="header">
        @if(auth()->user()->type == 'admin')
        <h5 class="float-right">
            <a href="{{route('users.index')}}" class="btn btn-sm btn-info"><i class="fa-solid fa-user-pen"></i> Kulanıcılar</a> 
        </h5>
        @endif
        <h5 class="">
            
            <a href="{{route('article.index',$user->id)}}" class="btn btn-sm btn-info"><i class="fa-solid fa-file-pen"></i> Makalelerim</a> 
        </h5>
    </x-slot>
            @foreach($users as $user)
            <div class="row py-3 mb-4 bg-secondary text-white rounded"  x-data="{ open{{ $loop->iteration }}: false }">
                <div class="col-11 ps-4 "><h4>{{ $user->name }} Kulanıcısına Ait Makaleler</h4> </div>
                <div class="col-1 ">
                    <div >
                        <a href ="#"   @click="open{{ $loop->iteration }} = true">
                            <i class="fa-solid fa-caret-down" x-show="open{{ $loop->iteration }} == false"></i>
                            <i class="fa-solid fa-caret-up" x-show="open{{ $loop->iteration }} == true"></i>
                        </a> 
                    </div>
                </div>               
                <!--  -->
                    <div @click.outside="open{{ $loop->iteration }} = false" x-show="open{{ $loop->iteration }}">
                        <table class="table table-success table-striped" >
                            <thead>
                                <tr>
                                    <th scope="col">Sıra</th>
                                    <th scope="col ">Makale</th>
                                    {{-- <th scope="col">Kulanıcı Makale Başlıkları</th> --}}
                                </tr>
                            </thead>
                            @foreach($user->articles as $article)
                            <tbody>     
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td> 
                                    <div class="row gl">
                                        <h5 class ="text-center"><strong>{{ $article->title }}</strong></h5>
                                        <div class="col-sm-4 ">
                                            @if($article->image)
                                                <a href="{{asset($article->image)}}" target="_blank">
                                                    <img src="{{asset($article->image)}}" class="img-responsive">
                                                </a>
                                            @else                                           
                                                <img src="https://picsum.photos/id/2{{ $loop->iteration }}7/400/200" alt="">
                                            @endif                                           
                                        </div>
                                        <div class="col-sm-8">
                                            <p class="mt-4">
                                                {{mb_strimwidth( $article->article , 0, 200, "...")}}
                                            </p>
                                        </div>
                                    </div>
                                    </td>
                                    
                                </tr>
                            </tbody>
                            @endforeach
                        </table>
                    </div>         
                </div>
            @endforeach
            {{$users->links()}}                
</x-app-layout>
