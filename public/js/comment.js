$(document).ready(function() {
    let url = window.location.href;
    let  urlSplit = url.split('/');
    let post_id = urlSplit[urlSplit.length - 1];
    let output = ``;
    axios.get('/ajax/getcomments',{
        params: {
            post_id: post_id
        }
    }). then(function (response) {
        $('#listComments').empty();
        var arrayComments = $.map(response.data.comments, function(value, index) {
            return [value];
        });
        var arrayUsers = $.map(response.data.users, function(value, index) {
            return [value];
        });
        arrayComments.forEach(function (comment) {
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
                    <img src="../`+ comment.user.avatar +`" alt="avatar" style="height: 50px;  border-radius: 50%;width: 50px">
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
                                    <img src="../`+ comment.user.avatar +`" alt="avatar" style="height: 50px;  border-radius: 50%;width: 50px">
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
    });

    $('#formComment').submit(function (e) {
        e.preventDefault();

        let content = $('#comment').val();
        console.log(content);
        if (content.length != 0 ){
            $('#formComment').trigger("reset");
            let url = window.location.href;
            urlSplit = url.split('/');
            post_id = urlSplit[urlSplit.length - 1];
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                axios.post('/ajax/newcomment', {
                    content,
                    post_id
                })
                    .then(function (response) {
                        let comment = response.data.comment;
                        let  outputAdd = `<div>
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <img src="../`+ comment.user.avatar +`" alt="avatar" style="height: 50px;  border-radius: 50%;width: 50px">
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
                        $('#listComments').prepend(outputAdd);
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
