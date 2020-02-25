
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


    $('#newPostForm').validate({
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
        .then(
            $('#newPostForm').submit(function (e) {
                e.preventDefault();
                var title = $('#title').val();
                var thisTags = $('#tags').val();
                var arrayTag = thisTags.split(",");
                var content = $('#content').val();
                console.log(title);
                console.log(arrayTag);
                console.log(content);
            })
        );


});


