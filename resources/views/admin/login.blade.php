@extends('admin.layout.admin_layout')

@section('title')
    Login Admin
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col">
                <form  method="POST" action="{{route('postLogin')}}" class="w-75">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email"  placeholder="Enter Your Email" required>
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
