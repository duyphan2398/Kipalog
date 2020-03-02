@extends('layouts.layout')

@section('title')
    Login
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col">
                <form  method="POST" action="/login" class="w-75">
                    @csrf
                    <div class="form-group">
                        <label for="username">UserName</label>
                        <input  value="{{old('username')}}" name="username" type="text" class="form-control" id="username"  placeholder="Enter Your UserName" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
@endsection
