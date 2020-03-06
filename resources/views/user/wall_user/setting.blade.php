@extends('user.layouts.layout')
@section('script-link')

@endsection


@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <form method="POST"  action="{{route('setting')}}" id="settingForm"  enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="avatar">Avatar</label>
                        <input value="{{$user->avatar}}" name="avatar" type="file" class="form-control" id="avatar">
                        <div class="text-danger mt-1">
                            @error('avatar')
                            *{{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input value="{{$user->name}}" name="name" type="text" class="form-control" id="name">
                        <div class="text-danger mt-1">
                            @error('name')
                            *{{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input value="{{$user->username}}" type="text" class="form-control" id="username" readonly>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input value="{{$user->email}}" type="email" class="form-control" id="email" readonly>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <small>(at least 6 characters - includes letter and number)</small></label>
                        <input name="password" type="password" class="form-control" id="password">
                        <div class="text-danger mt-1">
                            @error('password')
                            *{{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirm">Password Confirm</label>
                        <input name="passwordConfirm" type="password" class="form-control" id="passwordConfirm">
                        <div class="text-danger mt-1">
                            @error('passwordConfirm')
                            *{{$message}}
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-25">Lưu</button>
                </form>
            </div>
        </div>
    </div>
@endsection
