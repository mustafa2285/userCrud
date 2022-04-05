<x-guest-layout>
    <div class="container">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Anasayfa</a>
                    
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Giriş</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Kayıt ol</a>
                    @endif
                @endauth
            </div>
        @endif
        @auth
        <a type="submit"class="my-4 btn btn-light btn-sm w-100" href="{{route('dashboard')}}"><h5>Anasayfa</h5></a>
        @else
        <a type="submit"class="mt-4 btn btn-light btn-sm w-100" href="{{route('login')}}"><h5>Giriş yap</h5></a>
        <a type="submit"class="my-4 btn btn-light btn-sm w-100" href="{{ route('register') }}"><h5>Kayıt ol</h5></a>
        @endauth
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
                                    <th scope="col">Makale</th>
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
                                                {{ $article->article }}
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
    </div>
                      
</x-guest-layout>