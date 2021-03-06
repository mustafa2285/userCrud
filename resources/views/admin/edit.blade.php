<x-app-layout>
    <x-slot name="header">Kulanıcı Güncelle</x-slot>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action={{route('users.update',$user->id)}} enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label>Profil Fotoğrafı</label>
                @if($user-> profile_photo_path)
                <a href="{{ asset($user-> profile_photo_path)}}" target="_blank">
                    <img src="{{ asset($user-> profile_photo_path)}}" class="img-responsive w-20 rounded-pill my-2">
                </a>
                @else
                <a href="{{$user-> profile_photo_url}}" target="_blank">
                    <img src="{{$user-> profile_photo_url}}" class="img-responsive w-20 rounded-pill my-2">
                </a>
                @endif
                <input type="file" name="profile_photo_path" class="form-control">
            </div>
            <div class="form-group">
                <label>Ad Soyad</label>
                <input type="text" name="name" class="form-control" value={{ $user->name }}>
            </div>
            <div class="form-group">
                <label>e-mail</label>
                <input type="email" name="email" class="form-control" value={{ $user->email }}>
            </div>
            <div class="form-group">
                <label>Şifre</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>Şifreyi Onayla</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="form-group mt-3">
                <button type="submit"class="btn btn-success btn-sm w-100">Kulanıcı Güncelle</button>
            </div>
            </form>
        </div>
    </div>
</x-app-layout>