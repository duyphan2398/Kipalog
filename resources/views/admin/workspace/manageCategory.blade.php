@extends('admin.layout.admin_layout')
@section('title')
    Manage Admin
@endsection

@section("script-link")
    <script src="{{asset('js/admin/manageAdmin.js')}}"></script>
@endsection

@section('content')
    <style>
        form{
            margin-bottom: 10px;
        }
        input{
            border: 1px solid red;
            margin-right: 20px;
        }
    </style>
    <main role="main" class="mt-2 col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Admin</h1>
        </div>
        <div >
            <form method="POST" class="form-inline">
                @csrf
                <input type="text" class="form-control" placeholder="Enter name" id="name">
                <input type="email" class="form-control" placeholder="Enter email" id="email">
                <input type="password" class="form-control" placeholder="Enter password" id="password">
                <input type="password" class="form-control" placeholder="Enter password confirm" id="passwordConfirm">
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <div class="table-responsive">
            <table class="w-100 table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
                </thead>
                <tbody id="listAdmin">

                </tbody>
            </table>
            <div class="text-center mb-2"  id="loading" style="display: none">
                <img src="{{asset("images/ajax-loader.gif")}}" alt="loading...">
            </div>
        </div>
    </main>
@endsection
