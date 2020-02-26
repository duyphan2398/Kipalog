$(document).ready(function() {

    axios.get('/ajax/getcomments',{
    }). then(function (response) {
        console.log(response);
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
