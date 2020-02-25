$(document).ready(function() {
    let tags = [];

    axios.get('ajax/tags').then(result =>{
        result.data.forEach(function (tag) {
            tags.push(tag.name);
        });
        $('#tags').tokenfield({
            autocomplete: {
                source:  tags,
                delay: 100
            },
            showAutocompleteOnFocus: true
        });
    });


    var validator = $('#newPostForm').validate({
        rules: {
            title: "required",
            tags: "required",
            content: "required"
        },
        messages: {
            title: "VUI LÒNG NHẬP TIÊU ĐỀ",
            tags: "CHỌN ÍT NHẤT 1 TAG",
            content: "VUI LÒNG NHẬP NỘI DUNG"
        }
    })

    $('#newPostForm').submit(function (e) {
        if (validator.form()) {
            e.preventDefault();
            let title = $('#title').val();
            let thisTags = $('#tags').val();
            let arrayTags = thisTags.split(",");
            let content = $('#content').val();
            let token = document.head.querySelector('meta[name="csrf-token"]');
            console.log(token);
            if (token) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                axios.post('/ajax/newpost', {
                    title,
                    arrayTags,
                    content
                })
                    .then(function (response) {
                        alert('Tạo thành công');
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


