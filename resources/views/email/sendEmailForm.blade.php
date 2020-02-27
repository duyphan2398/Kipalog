@extends('user.layouts.layout')

@section('title')
    Email
@endsection

@section('content')
    <div class="container mb-4">
        <div class="row">
            <div class="col">
                <form  method="POST" action="/resetpassword" class="w-75">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="email" class="form-control" id="email"  placeholder="Enter Your email" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Send Request</button>
                </form>
            </div>
        </div>
    </div>
@endsection
