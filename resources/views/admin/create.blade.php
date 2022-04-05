<x-app-layout>
    <x-slot name="header">Kulanıcı Oluştur</x-slot>
    
    <div class="card">
        <div class="card-body">
            <form method="POST" action={{route('users.store')}} enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label>Ad Soyad</label>
                <input type="text" name="name" class="form-control" value={{old('name')}}>
            </div>
            <div class="form-group">
                <label>e-mail</label>
                <input type="email" name="email" class="form-control" value={{old('email')}}>
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
                <button type="submit"class="btn btn-success btn-sm w-100">Kulanıcı Oluştur</button>
            </div>
            </form>
        </div>
    </div>
</x-app-layout>