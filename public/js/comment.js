$(document).ready(function() {
    let url = window.location.href;
    let  urlSplit = url.split('/');
    let post_id = urlSplit[urlSplit.length - 1];

    axios.get('/ajax/getcomments',{
        params: {
            post_id: post_id
        }
    }). then(function (response) {
        console.log(typeof (response.data.comments));
        $('#listComments').empty();
        var arrayResult = $.map(response.data.comments, function(value, index) {
            return [value];
        });
        arrayResult.forEach(function (comment) {
            if (comment.user_id ){
                console.log("dsaddsds");

            }
            else
            {
                console.log("0000");
            }
        });

    });








    $('#formComment').submit(function (e) {
        e.preventDefault();
        let content = $('#comment').val();
        if (!content){
            alert("Vui lòng nhập Cmt");
        }
        else{
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
                        alert('Tao thanh cong '+response);
                    })
                    .catch(function (error) {
                        alert('Tạo KHÔNG thành công');
                    })
            } else {
                console.error('CSRF token not found ! ');
            }
        }
    });

});
