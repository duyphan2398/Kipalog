function removeTag(str){
    return str.replace(/(<([^>]+)>)/ig,"");
}
$(document).ready(function () {
    let currentPageNewPosts = 0;
    let currentPageGoodPosts = 0;
    let outputNewPosts = '';
    let outputGoodPosts = '';
    let maxPageNewPosts = 1;
    let maxPageGoodPosts = 1;
    let outputSearch =  '';

    $('#moreNewPosts').click(function () {
        currentPageNewPosts++;
        $.when(
            $('#buttonMoreNewPosts').removeAttr("style").hide(),
            $('#ajax-loader').show(),
            $.ajax({
                url: location.origin +'/ajax/getNewPosts?page='+currentPageNewPosts,
                type: 'GET',
                success: function (result) {
                    result.post.data.forEach(function (post){
                        outputNewPosts += `<div class="row">
                            <div class="col-1 ">
                                <img src="`+ result.user[post.id].avatar +`"  style="height: 50px;  border-radius: 50%;width: 50px">
                            </div>
                            <div class="col-11 " style="word-wrap: break-word;">
                                <h3 class="p-2" style="display: block">
                                <a href="viewpost/`+post.id+`">` + removeTag(post.title) +`</a>
                                </h3>
                                <div class="tag mb-1">`;
                        result.tags[post.id].forEach(function (tag) {
                            outputNewPosts += `<button class="btn btn-success mr-2">
                                                        <a href="/tag/`+tag.id+`">
                                                         `+ removeTag(tag.name) +`
                                                        </a>
                                                </button>`;
                        });
                        outputNewPosts +=   `</div>
                                <div class="content" style="overflow: hidden; height: 100px">
                                    `+  removeTag(post.content) +`
                                </div>
                                <div style="display: inline-block; float: left">
                                    By <a href="">`+ removeTag(result .user[post.id].name) +`</a>  vào lúc `+ post.created_at +`
                                </div>
                                <div style="display: inline-block; float: right">
                                    <a href="viewpost/`+post.id+`">`+post.comments.length+`</a> Bình Luận
                                    <||>
                                    <a href="viewpost/`+post.id+`">0</a> Lượt thích
                                </div>
                            </div>
                        </div>
                        <hr>`;
                    });
                    $('#listContent').empty().append(outputNewPosts);
                    maxPageNewPosts = result.post.last_page;
                },
                error: function (result) {
                    console.log(result);
                }
            })
        )
            .then(function() {
                $('#ajax-loader').removeAttr("style").hide();
                if (maxPageNewPosts <= currentPageNewPosts){
                    $('#buttonMoreNewPosts').removeAttr("style").hide();
                }
                else {
                    $('#buttonMoreNewPosts').show();
                }
            });
    });


    $('#moreGoodPosts').click(function () {
        currentPageGoodPosts++;
        $.when(
            $('#ajax-loader').show(),
            $('#buttonMoreGoodPosts').removeAttr("style").hide(),
            $.ajax({
                url: location.origin +'/ajax/getGoodPosts?page='+currentPageGoodPosts,
                type: 'GET',
                success: function (result) {
                    result.post.data.forEach(function (post){
                        outputGoodPosts += `<div class="row">
                            <div class="col-1 ">
                                <img src="`+ result.user[post.id].avatar +`"  style="height: 50px;  border-radius: 50%;width: 50px">
                            </div>
                            <div class="col-11 " style="word-wrap: break-word;">
                                <h3 class="p-2">
                                    <a  href="viewpost/`+post.id+`">`+ removeTag(post.title) +`</a>
                                </h3>
                                <div class="tag mb-1">`;
                        result.tags[post.id].forEach(function (tag) {
                            outputGoodPosts +=`<button class="btn btn-success mr-2">
                                                        <a href="/tag/`+tag.id+`">
                                                            `+ removeTag(tag.name) +`
                                                        </a>
                                                </button>`;
                        });
                        outputGoodPosts +=   `</div>
                                <div class="content" style="overflow: hidden; height: 100px">
                                    `+ removeTag(post.content) +`
                                </div>
                                <div style="display: inline-block; float: left">
                                    By <a href="">`+ removeTag(result.user[post.id].name) +`</a>  vào lúc `+ post.created_at +`
                                </div>
                                <div style="display: inline-block; float: right">
                                    <a href="viewpost/`+post.id+`">\`+post.comments.length+\`</a> Bình Luận
                                    <||>
                                    <a href="viewpost/`+post.id+`">0</a> Lượt thích
                                </div>
                            </div>
                        </div>
                        <hr>`;
                    });

                    $('#listContent').empty().append(outputGoodPosts);
                    maxPageGoodPosts = result.post.last_page;
                },
                error: function (result) {
                    console.log(result);
                }
            })
        )
            .then(function () {
                $('#ajax-loader').removeAttr("style").hide();
                if (maxPageGoodPosts <= currentPageGoodPosts){
                    $('#buttonMoreGoodPosts').removeAttr("style").hide();
                }
                else {
                    $('#buttonMoreGoodPosts').show();
                }
            });
    });


    $('#newPosts').click(function () {
        $('#listContent').empty().append(outputNewPosts);
        $('#buttonMoreGoodPosts').removeAttr("style").hide();
        if (currentPageNewPosts < maxPageNewPosts){
            $("#buttonMoreNewPosts").show();
        }
    });

    $('#goodPosts').click(function () {
        $('#listContent').empty().append(outputGoodPosts);
        $('#buttonMoreNewPosts').removeAttr("style").hide();
        if (currentPageGoodPosts == 0 ) {
            $('#moreGoodPosts').trigger( "click" );
        }
        if ((currentPageGoodPosts< maxPageGoodPosts) && (currentPageGoodPosts != 0)) {
            $("#buttonMoreGoodPosts").show();
        }
    });

    $('#searchForm').submit(function (e) {
        e.preventDefault();
        var searchInput = $("#searchInput").val();
        $("#searchForm").trigger("reset");
        $.when(
            $('#listContent').empty(),
            $('#buttonMoreGoodPosts').removeAttr("style").hide(),
            $('#buttonMoreNewPosts').removeAttr("style").hide(),
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
                                <a href="viewpost/`+post.id+`">`+removeTag(post.title)+`</a>
                                </h3>
                                <div class="tag mb-1">`;
                        result.tags[post.id].forEach(function (tag) {
                            outputSearch +=`<button class="btn btn-success mr-2">
                                                        <a href="/tag/`+tag.id+`">
                                                         `+ removeTag(tag.name) +`
                                                        </a>
                                                </button>`;
                        });
                        outputSearch +=   `</div>
                                <div class="content" style="overflow: hidden; height: 100px">
                                    `+ removeTag(post.content) +`
                                </div>
                                <div style="display: inline-block; float: left">
                                    By <a href="">`+ removeTag(result.user[post.id].name) +`</a>  vào lúc `+ post.created_at +`
                                </div>
                                <div style="display: inline-block; float: right">
                                    <a href="viewpost/`+post.id+`">\`+post.comments.length+\`</a> Bình Luận
                                    <||>
                                    <a href="viewpost/`+post.id+`">0</a> Lượt thích
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

    axios.get(location.origin+'/ajax/getPopularTags').then(result => {

        $("#chuDeNoiBat").empty();
        result.data.tags.forEach(function (tag) {
            $("#chuDeNoiBat").append(`
                    <button class="btn-danger btn mb-1">
                               <a href="/tag/`+tag.id+`">`+removeTag(tag.name)+`</a>
                    </button> `);
        });
    });
});

$( window ).bind('load',function() {
    $('#moreNewPosts').click();
});
