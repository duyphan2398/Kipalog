@extends('admin.layout.admin_layout')
@section('title')
    Manage Posts
@endsection

@section("script-link")
    <script src="{{asset('js/admin/managePost.js')}}"></script>
@endsection

@section('content')
    <style>
        ::-webkit-scrollbar {
            width: 0px;
            background: transparent;
        }
    </style>
    <main role="main" class="mt-2 col-md-9 ml-sm-auto col-lg-10 px-4"><div class="chartjs-size-monitor" style="position: absolute; left: 0px; top: 0px; right: 0px; bottom: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Manage Post</h1>
        </div>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Tag</th>
                    <th>Content</th>
                    <th>By</th>
                    <th>Created_at</th>
                    <th>State</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody id="listPost">

                </tbody>
            </table>
            <div class="text-center mb-2"  id="loading" style="display: none">
                <img src="{{asset("images/ajax-loader.gif")}}" alt="loading...">
            </div>
            <div id="loadMore" class="text-center" style="display: none">
                <button id= "moreNewPosts"class="btn btn-primary w-50">
                    Xem thêm
                </button>
            </div>
        </div>
    </main>
@endsection
