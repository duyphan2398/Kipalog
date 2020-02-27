$(document).ready(function () {
    var pageBaiVietMoi = 0;
    var pageBaiVietHay = 0;
    var outputBaiVietMoi = '';
    var outputBaiVietHay = '';
    var maxPageBaiVietMoi = 1;
    var maxPageBaiVietHay = 1;
    var outputSearch =  '';

    $('#addBaiVietMoi').click(function () {
        pageBaiVietMoi++;
        $.when(
            $('#buttonAddBaiVietMoi').removeAttr("style").hide(),
            $('#ajax-loader').show(),
            $.ajax({
                url: location.origin +'/ajax/baivietmoi?page='+pageBaiVietMoi,
                type: 'GET',
                success: function (result) {
                    result.post.data.forEach(function (post){
                        outputBaiVietMoi += `<div class="row">
                            <div class="col-1 ">
                                <img src="`+ result.user[post.id].avatar +`"  style="height: 50px;  border-radius: 50%;width: 50px">
                            </div>
                            <div class="col-11 " style="word-wrap: break-word;">
                                <h3 class="p-2">
                                <a href="viewpost/`+post.id+`">` + post.title +`</a>
                                </h3>
                                <div class="tag mb-1">`;
                        result.tags[post.id].forEach(function (tag) {
                            outputBaiVietMoi += `<button class="btn btn-success mr-2">
                                                        <a href="/tag/`+tag.id+`">
                                                         `+ tag.name +`
                                                        </a>
                                                </button>`;
                        });
                        outputBaiVietMoi +=   `</div>
                                <div class="content" style="overflow: hidden; height: 100px">
                                    `+ post.content +`
                                </div>
                                <div>
                                    By <a href="">`+ result.user[post.id].name +`</a>  vào lúc `+ post.created_at +`
                                </div>
                            </div>
                        </div>
                        <hr>`;
                    });
                    $('#listContent').empty().append(outputBaiVietMoi);
                    maxPageBaiVietMoi = result.post.last_page;
                },
                error: function (result) {
                    console.log(result);
                }
            })
        )
            .then(function() {
                $('#ajax-loader').removeAttr("style").hide();
                if (maxPageBaiVietMoi <= pageBaiVietMoi){
                    $('#buttonAddBaiVietMoi').removeAttr("style").hide();
                }
                else {
                    $('#buttonAddBaiVietMoi').show();
                }
            });
    });


    $('#addBaiVietHay').click(function () {
        pageBaiVietHay++;
        $.when(
            $('#ajax-loader').show(),
            $('#buttonAddBaiVietHay').removeAttr("style").hide(),
            $.ajax({
                url: location.origin +'/ajax/baiviethay?page='+pageBaiVietHay,
                type: 'GET',
                success: function (result) {
                    result.post.data.forEach(function (post){
                        outputBaiVietHay += `<div class="row">
                            <div class="col-1 ">
                                <img src="`+ result.user[post.id].avatar +`"  style="height: 50px;  border-radius: 50%;width: 50px">
                            </div>
                            <div class="col-11 " style="word-wrap: break-word;">
                                <h3 class="p-2">
                                <a  href="viewpost/`+post.id+`">`+ post.title +`</a>
                                </h3>
                                <div class="tag mb-1">`;
                        result.tags[post.id].forEach(function (tag) {
                            outputBaiVietHay +=`<button class="btn btn-success mr-2">
                                                        <a href="/tag/`+tag.id+`">
                                                         `+ tag.name +`
                                                        </a>
                                                </button>`;
                        });
                        outputBaiVietHay +=   `</div>
                                <div class="content" style="overflow: hidden; height: 100px">
                                    `+ post.content +`
                                </div>
                                <div>
                                    By <a href="">`+ result.user[post.id].name +`</a>  vào lúc `+ post.created_at +`
                                </div>
                            </div>
                        </div>
                        <hr>`;
                    });

                    $('#listContent').empty().append(outputBaiVietHay);
                    maxPageBaiVietHay = result.post.last_page;
                },
                error: function (result) {
                    console.log(result);
                }
            })
        )
            .then(function () {
                $('#ajax-loader').removeAttr("style").hide();
                if (maxPageBaiVietHay <= pageBaiVietHay){
                    $('#buttonAddBaiVietHay').removeAttr("style").hide();
                }
                else {
                    $('#buttonAddBaiVietHay').show();
                }
            });
    });


    $('#baivietmoi').click(function () {
        $('#listContent').empty().append(outputBaiVietMoi);
        $('#buttonAddBaiVietHay').removeAttr("style").hide();
        if (pageBaiVietMoi < maxPageBaiVietMoi){
            $("#buttonAddBaiVietMoi").show();
        }
    });

    $('#baiviethay').click(function () {
        $('#listContent').empty().append(outputBaiVietHay);
        $('#buttonAddBaiVietMoi').removeAttr("style").hide();
        if (pageBaiVietHay == 0 ) {
            $('#addBaiVietHay').trigger( "click" );
        }
        if ((pageBaiVietHay < maxPageBaiVietHay) && (pageBaiVietHay != 0)) {
            $("#buttonAddBaiVietHay").show();
        }
    });

    $('#searchForm').submit(function (e) {
        e.preventDefault();
        var searchInput = $("#searchInput").val();
        $("#searchForm").trigger("reset");
        $.when(
            $('#listContent').empty(),
            $('#buttonAddBaiVietHay').removeAttr("style").hide(),
            $('#buttonAddBaiVietMoi').removeAttr("style").hide(),
            $('#ajax-loader').show(),
            $.ajax({
                url: location.origin+'/ajax/search',
                type: 'GET',
                data: {searchInput: searchInput},
                dataType: 'JSON',
                success: function(result){
                    outputSearch =  ``;
                    result.searchPosts.forEach(function (post) {
                        outputSearch += `<div class="row">
                            <div class="col-1 ">
                                <img src="`+location.origin+`/`+ result.user[post.id].avatar +`"  style="height: 50px;  border-radius: 50%;width: 50px">
                            </div>
                             <div class="col-11 " style="word-wrap: break-word;">
                                <h3 class="p-2">
                                <a href="viewpost/`+post.id+`">`+post.title+`</a>
                                </h3>
                                <div class="tag mb-1">`;
                        result.tags[post.id].forEach(function (tag) {
                            outputSearch +=`<button class="btn btn-success mr-2">
                                                        <a href="/tag/`+tag.id+`">
                                                         `+ tag.name +`
                                                        </a>
                                                </button>`;
                        });
                        outputSearch +=   `</div>
                                <div class="content" style="overflow: hidden; height: 100px">
                                    `+ post.content +`
                                </div>
                                <div>
                                    By <a href="">`+ result.user[post.id].name +`</a>  vào lúc `+ post.created_at +`
                                </div>
                            </div>
                        </div>
                        <hr>`;
                    });
                    $('#listContent').append(outputSearch);
                },
                error: function() {
                    $('#listContent')
                        .append('<h1>  Can not Find  </h1>');
                    $('#ajax-loader').removeAttr("style").hide();
                }
            })
        ).then(function () {
            $('#ajax-loader').removeAttr("style").hide();
        })

    });

    axios.get(location.origin+'/ajax/tagsNoiBat').then(result => {

        $("#chuDeNoiBat").empty();
        result.data.tags.forEach(function (tag) {
            $("#chuDeNoiBat").append(`
                    <button class="btn-danger btn mb-1">
                               <a href="/tag/`+tag.id+`">`+tag.name+`</a>
                    </button> `);
        });
    });
});

$( window ).bind('load',function() {
    $('#addBaiVietMoi').click();
});
