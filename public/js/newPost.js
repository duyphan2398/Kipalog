$(document).ready(function() {
    let tags = [];
    axios.get(location.origin +'/ajax/tags').then(result =>{
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

        $('#tags')
            .on('tokenfield:createtoken', function (e) {
                let existTokens = $(this).tokenfield('getTokens');
                $.each(existTokens, function (index, token) {
                    if (token.value === e.attrs.value) {
                        e.preventDefault();
                    }
                })
            })
            .on('tokenfield:edittoken', function (e) {
                console.log("dsadsadsadsa");
                console.log($("label[for=tags]").val());

            })
    });


    $('#newPostForm').submit(function (e) {
        e.preventDefault();
        var validator = $('#newPostForm').validate({
            rules: {
                title: "required",
                tags: "required",
                content: "required"
            },
            messages: {
                title: "Title Is Required",
                tags: "Please Choose At Least 1 Tag",
                content: "Content Is Required"
            }
        });
        if (validator.form()) {
            let title = $('#title').val();
            let thisTags = $('#tags').val();
            let arrayTagsFillter = thisTags.split(",");
            let arrayTags = arrayTagsFillter.filter((element, indexOfElement) => {
                return indexOfElement === arrayTagsFillter.indexOf(element);
            });
            let content = $('#content').val();
            let token = document.head.querySelector('meta[name="csrf-token"]');
            if (token) {
                window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
                axios.post(location.origin +'/ajax/newpost', {
                    title,
                    arrayTags,
                    content
                })
                    .then(function (response) {
                        $("#newPostForm").trigger("reset");
                        alert('Tạo thành công');
                    })
                    .catch(function (error) {
                        alert('Tạo KHÔNG thành công');
                    })
            } else {
                console.error('CSRF token not found ! ');
            }
        }
        else{
            if ($("label[for='tags']").text()){
                var text = $("label[for='tags']").text();
                $("label[for='tags-tokenfield']").innerText(text);
                $("label[for='tags']").removeAttr("style").hide();

            };
        }
    });
});


