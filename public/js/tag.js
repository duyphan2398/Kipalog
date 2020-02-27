let url = window.location.href;
let  urlSplit = url.split('/');
let tag_id = urlSplit[urlSplit.length - 1];
let output = ``;
let currentPageTag = 1;
let lastPageTag = 0;

$(document).ready(function() {
    $("#addMore").click(function () {
        axios.get('/ajax/getPostTag/'+ tag_id, {
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
                                <img src="../`+post.user.avatar +`"  style="height: 50px;  border-radius: 50%;width: 50px">
                            </div>
                            <div class="col-11 " style="word-wrap: break-word;">
                                <h3 class="p-2">
                                <a href="viewpost/`+post.id+`">` + post.title +`</a>
                                </h3>
                                <div class="tag mb-1">`;
                post.tags.forEach(function (tag) {
                    output += `<button class="btn btn-success mr-2">
                                   <a href="/tag/`+tag.id+`">
                                          `+ tag.name +`
                                   </a>
                               </button>`;
                });
                output +=   `</div>
                                <div class="content" style="overflow: hidden; height: 100px">
                                    `+ post.content +`
                                </div>
                                <div>
                                    By <a href="">`+ post.user.name +`</a>  vào lúc `+ post.created_at +`
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

$( window ).bind('load',function() {
    $('#addMore').click();
});


