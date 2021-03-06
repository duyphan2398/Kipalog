let url = window.location.href;
let  urlSplit = url.split('/');
let tag_id = urlSplit[urlSplit.length - 1];
let output = ``;
let currentPageTag = 1;
let lastPageTag = 0;

$(document).ready(function() {
    $("#addMore").click(function () {
        axios.get(location.origin +'/ajax/getPostsByTag/'+ tag_id, {
                params: {
                    page: currentPageTag
                }
            },
            $('#addMore').removeAttr("style").hide(),
            $('#loading').show()
        ). then(function (response) {
            lastPageTag = response.data.posts.last_page;
            if (response.data.posts.data.length == 0){
                $('#loading').removeAttr("style").hide();
                return;
            }
            response.data.posts.data.forEach(function (post) {
                output = `<div class="row">
                            <div class="col-1 ">
                                <img src="`+location.origin+`/`+post.user.avatar +`"  style="border: 2px solid red; height: 50px;  border-radius: 50%;width: 50px">
                            </div>
                            <div class="col-11 " style="word-wrap: break-word;">
                                <h3 class="p-2">
                                <a href="`+location.origin +`/viewpost/`+post.id+`">` + post.title +`</a>
                                </h3>
                                <div class="tag mb-1">`;
                post.tags.forEach(function (tag) {
                    output += `<a href="`+location.origin+`/tag/`+tag.id+`">
                                   <button class="btn btn-success mr-2">
                                          `+ removeTag(tag.name) +`
                                          </button>
                                   </a>`;
                });
                output +=   `</div>
                                <div class="content" style="overflow: hidden; height: 100px">
                                    `+ removeTag(post.content) +`
                                </div>
                                <div>
                                    By <a href="">`+ removeTag(post.user.name) +`</a>  when `+ post.created_at +`
                                </div>
                            </div>
                        </div>
                        <hr>`;
                $('#listContent').append(output);
            });
            if (currentPageTag == lastPageTag){
                $('#addMore').removeAttr("style").hide();
                $('#loading').removeAttr("style").hide();
            }
            else{
                $('#loading').removeAttr("style").hide();
                $('#addMore').show();
            }
            currentPageTag++;
        })
    });
});

$(window).on('load', function () {
    $('#addMore').click();
});
