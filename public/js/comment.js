let url = window.location.href;
let  urlSplit = url.split('/');
let post_id = urlSplit[urlSplit.length - 1];
let output = ``;
let currentPageComment = 0;
let lastPageComment = 0;
var pusher = new Pusher('5e1689f8ea39fd6cd5e6', {
    cluster: 'ap1',
    forceTLS: true
});
var channel = pusher.subscribe('cmt');

$(document).ready(function() {

    channel.bind('cmt-event', function(data) {
        let comment = data.comment;
        if (comment.user_id != user_id){
            output = `<div>
                <ul class="list-inline">
                    <li class="list-inline-item" style="height: 50px;  border-radius: 50%;width: 50px">
                    </li>
                    <li class=" list-inline-item" >
                    <div class="container-fluid">
                    <div class="row mb-1 ">
                    <div class="col text-right">
                    `+comment.user.name+ ` `+ comment.created_at +`</small>
                </div>
                </div>
                <div  style="background-color:#20202030; border-radius: 15px; border: 1px solid #11a0d5 " class="row clearfix">
                    <div style="width: 600px" class="p-2">
                    `+ comment.content +`
                </div>
                </div>
                </div>
                </li>
                <li class="list-inline-item">
                    <img src="`+location.origin +'/'+ comment.user.avatar +`" alt="avatar" style="height: 50px;  border-radius: 50%;width: 50px">
                    </li>
                    </ul>
                    </div>`;

            $('#listComments').prepend(output);
        }
        else
        {
             output = `<div>
                          <ul class="list-inline">
                              <li class="list-inline-item">
                                  <img src="`+location.origin +'/'+ comment.user.avatar +`" alt="avatar" style="height: 50px;  border-radius: 50%;width: 50px">
                              </li>
                              <li class=" list-inline-item" >
                                  <div class="container-fluid">
                                      <div class="row mb-1">
                                          <small> <strong>Me</strong>  `+ comment.created_at +`</small>
                                      </div>
                                      <div  style="background-color:#20202030; border-radius: 15px; border: 1px solid #11a0d5 " class="row">
                                          <div style="width: 600px" class="p-2">
                                               `+ comment.content +`
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <li class="list-inline-item" style="height: 50px;  border-radius: 50%;width: 50px">
                              </li>
                          </ul>
                      </div>`;
            $('#listComments').prepend(output);
        }
    });


    $("#loadButton").click(function () {
        axios.get(location.origin +'/ajax/getcomments/'+ post_id, {
                params: {
                    page: currentPageComment
                }
            },
            $('#loadButton').removeAttr("style").hide(),
            $('#loadImage').show()
        ). then(function (response) {
            currentPageComment++;
            lastPageComment = response.data.comments.last_page;
            if (response.data.comments.data.length ==0){
                $('#loadImage').removeAttr("style").hide();
                return;
            }
            response.data.comments.data.forEach(function (comment) {
                if (comment.user_id != user_id){
                    output = `<div>
                <ul class="list-inline">
                    <li class="list-inline-item" style="height: 50px;  border-radius: 50%;width: 50px">
                    </li>
                    <li class=" list-inline-item" >
                    <div class="container-fluid">
                    <div class="row mb-1 ">
                    <div class="col text-right">
                    `+comment.user.name+ ` `+ comment.created_at +`</small>
                </div>
                </div>
                <div  style="background-color:#20202030; border-radius: 15px; border: 1px solid #11a0d5 " class="row clearfix">
                    <div style="width: 600px" class="p-2">
                    `+ comment.content +`
                </div>
                </div>
                </div>
                </li>
                <li class="list-inline-item">
                    <img src="`+location.origin+'/'+comment.user.avatar +`" alt="avatar" style="height: 50px;  border-radius: 50%;width: 50px">
                    </li>
                    </ul>
                    </div>`;
                    $('#listComments').append(output);
                }
                else
                {
                    output = `<div>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img src="`+location.origin+'/'+comment.user.avatar +`" alt="avatar" style="height: 50px;  border-radius: 50%;width: 50px">
                                </li>
                                <li class=" list-inline-item" >
                                    <div class="container-fluid">
                                        <div class="row mb-1">
                                            <small> <strong>Me</strong>  `+ comment.created_at +`</small>
                                        </div>
                                        <div  style="background-color:#20202030; border-radius: 15px; border: 1px solid #11a0d5 " class="row">
                                            <div style="width: 600px" class="p-2">
                                                 `+ comment.content +`
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="list-inline-item" style="height: 50px;  border-radius: 50%;width: 50px">
                                </li>
                            </ul>
                        </div>`;
                    $('#listComments').append(output);
                }
            });

            if (currentPageComment == lastPageComment){
                $('#loadButton').removeAttr("style").hide();
                $('#loadImage').removeAttr("style").hide();
            }
            else{
                $('#loadImage').removeAttr("style").hide();
                $('#loadButton').show();
            }

        });
    });

    $('#formComment').submit(function (e) {
        e.preventDefault();
        let content = $('#comment').val();
        if (content.length != 0 ){
            $('#formComment').trigger("reset");
            let url = window.location.href;
            urlSplit = url.split('/');
            post_id = urlSplit[urlSplit.length - 1];
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                axios.post(location.origin +'/ajax/newcomment', {
                    content,
                    post_id
                })
                    .then(function (response) {
                        return;
                    })
                    .catch(function (error) {
                        alert('Tạo KHÔNG thành công');
                    })
            } else {
                console.error('CSRF token not found ! ');
            }
        }
        else{
            alert("Vui lòng nhập Cmt");
        }
    });
});

$( window ).bind('load',function() {
    $('#loadButton').click();
});


