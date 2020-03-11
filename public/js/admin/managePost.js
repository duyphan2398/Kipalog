
let currentPagePosts = 0;
let outputPagePosts = '';
let maxPagePosts = 1;
let token = document.head.querySelector('meta[name="csrf-token"]');
$(document).ready(function () {
    $("#loadMore").click(function () {
        currentPagePosts++;
        $('#loadMore').removeAttr("style").hide();
        $('#loading').show();
        axios.get(location.origin +'/ajax/admin/getposts?page='+currentPagePosts)
            .then(function (response) {
                outputPagePosts = '';
                maxPagePosts = response.data.posts.last_page;
                response.data.posts.data.forEach(function (post) {
                    outputPagePosts += `
                <tr id="`+post.id+`">
                    <td>`+post.id+`</td>
                    <td style="width: 150px">
                        <div style="height: 200px; overflow: scroll">
                            `+post.title+`
                        </div>
                    </td>
                    <td>`;
                    post.tags.forEach(function (tag) {
                            outputPagePosts += tag.name.toString()+ `<br>`;
                    });
                    outputPagePosts += `</td>
                    <td style="width: 350px">
                        <div style="height: 200px; overflow: scroll">
                        `+post.content+`
                        </div>
                    </td>

                     <td>
                            Id: `+post.user.id+`
                            <br>Username: `+post.user.username+`
                            <br>Email: `+post.user.email+`
                            <br>Active: `+(post.user.deleted_at == null?`On`:`Off`)+`
                    </td>
                    <td>`+post.created_at+`</td>
                    <td>`+post.state+`</td>
                    <td>
                            <button name="`+post.id+`" class="delete btn btn-danger">
                                Delete
                            </button>
                    </td>
                </tr>
            `;
                });
                $('#listPost').append(outputPagePosts);
            })
            .then(function () {
                if (currentPagePosts == maxPagePosts){
                    $('#loading').removeAttr("style").hide();
                    $('#loadMore').removeAttr("style").hide();
                }
                else{
                    $('#loading').removeAttr("style").hide();
                    $('#loadMore').show();
                }
            })
    });

    jQuery(document).on('click',".delete",function () {
        if (confirm(" Are you sure ?")) {
            post_id = this.name;
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            axios.delete(location.origin +'/ajax/admin/deletepost',{
                params:{
                    post_id: post_id
                }
            }).then(function (response) {
                console.log("ok");
                $("tr#"+post_id+"").remove();
            })
        }
    });
});

$(window).on('load', function () {
    $('#loadMore').click();
});
