@extends('layouts.layout')

@section('title')
    Reset Password
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col">
                <form  method="POST" action="/resetpassword/form/{{$token}}/{{$email}}" class="w-75">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email"  placeholder="Enter Your email" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password"  placeholder="Enter Your password" required>
                    </div>

                    <div class="form-group">
                        <label for="passwordConfirm">Password Confirm</label>
                        <input name="passwordConfirm" type="password" class="form-control" id="passwordConfirm"  placeholder="Enter Your password confirm" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Request</button>
                </form>
            </div>
        </div>
    </div>
@endsection
