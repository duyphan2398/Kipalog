
let currentPageUsers = 0;
let outputPageUsers = '';
let maxPageUsers = 1;
let token = document.head.querySelector('meta[name="csrf-token"]');
$(document).ready(function () {
    $("#loadMore").click(function () {
        currentPageUsers++;
        $('#loadMore').removeAttr("style").hide();
        $('#loading').show();
        axios.get(location.origin +'/ajax/admin/getusers?page='+currentPageUsers)
            .then(function (response) {
                outputPageUsers = '';
                maxPageUsers = response.data.users.last_page;
                response.data.users.data.forEach(function (user) {
                    outputPageUsers += `
                    <tr id="`+user.id+`">
                        <td>`+user.id+`</td>
                        <td>`+user.name+`</td>
                        <td>`+user.username+`</td>
                        <td>`+user.email+`</td>
                        <td>`+user.created_at+`</td>
                        <td>`;
                    if(user.deleted_at == null){
                        outputPageUsers +=
                            `<button name="`+user.id+`" id="active`+user.id+`" class="btn btn-success active" style="display: block">On</button>
                             <button name="`+user.id+`"  id="notActive`+user.id+`"class="btn btn-warning active" style="display: none">Off</button>`;
                    }
                    else {
                        outputPageUsers +=
                            `<button name="`+user.id+`" id="active`+user.id+`" class="btn btn-success active" style="display: none">On</button>
                             <button name="`+user.id+`" id="notActive`+user.id+`"class="btn btn-warning active" style="display: block">Off</button>`;;
                    }
                    outputPageUsers +=` </td>
                                   <td>
                                        <button name="`+user.id+`" class="delete btn btn-danger">
                                            Delete
                                        </button>
                                    </td>
                                </tr> `;
                });
                $('#listUser').append(outputPageUsers);
            })
            .then(function () {
                if (currentPageUsers == maxPageUsers){
                    $('#loading').removeAttr("style").hide();
                    $('#loadMore').removeAttr("style").hide();
                }
                else{
                    $('#loading').removeAttr("style").hide();
                    $('#loadMore').show();
                }

            })
    });

    jQuery(document).on('click',".active",function () {
        user_id = this.name;
        if (this.id == 'active'+user_id){
            $('#active'+user_id).removeAttr("style").hide();
            $('#notActive'+user_id).show();
        }
        else{
            $('#notActive'+user_id).removeAttr("style").hide();
            $('#active'+user_id).show();
        }
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        axios.delete(location.origin +'/ajax/admin/softDeleteUser',{
            params:{
                user_id: user_id
            }
        })
    });

    jQuery(document).on('click',".delete",function () {
        if (confirm(" Are you sure ?")) {
            user_id = this.name;
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            axios.delete(location.origin +'/ajax/admin/deleteUserCompletely',{
                params:{
                    user_id: user_id
                }
            }).then(function (response) {
                $("tr#"+user_id+"").remove();
            })
        }
    });
});

$(window).on('load', function () {
    $('#loadMore').click();
});

