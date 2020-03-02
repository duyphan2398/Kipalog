@extends('user.layouts.layout')

@section('title')
    Register
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col">
                <form  method="POST" action="/register" class="w-75">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name <small>(maximum 15 - include only letter)</small></label>
                        <input  value="{{old('name')}}"  name="name" type="text" class="form-control" id="name"  placeholder="" required>
                        <div class="text-danger mt-1">
                            @error('name')
                            *{{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username <small>(maximum 15 - include letters <b>or</b> numbers)</small></label>
                        <input value="{{old('username')}}" name="username" type="text" class="form-control" id="username"  placeholder="" required>
                        <div class="text-danger mt-1">
                            @error('username')
                            *{{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input value="{{old('email')}}" name="email" type="email" class="form-control" id="email"  placeholder="" required>
                        <div class="text-danger mt-1">
                            @error('email')
                            *{{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <small>(at least 6 characters - includes letter and number)</small></label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="" required>
                        <div class="text-danger mt-1">
                            @error('password')
                            *{{$message}}
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirm">Confirm Password <small>(must same password)</small></label>
                        <input name="passwordConfirm" type="password" class="form-control" id="passwordConfirm" placeholder="" required>
                        <div class="text-danger mt-1">
                            @error('passwordConfirm')
                            *{{$message}}
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>

        </div>
    </div>
@endsection
