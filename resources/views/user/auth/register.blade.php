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
                        <label for="name">Name</label>
                        <input  value="{{old('name')}}"  name="name" type="text" class="form-control" id="name"  placeholder="Enter Your Name" required>
                    </div>
                    <div class="form-group">
                        <label for="username">UserName</label>
                        <input value="{{old('username')}}" name="username" type="text" class="form-control" id="username"  placeholder="Enter Your UserName" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input value="{{old('email')}}" name="email" type="email" class="form-control" id="email"  placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="passwordConfirm">Confirm Password</label>
                        <input name="passwordConfirm" type="password" class="form-control" id="passwordConfirm" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>

        </div>
    </div>
@endsection
