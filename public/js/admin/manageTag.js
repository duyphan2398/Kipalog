let token = document.head.querySelector('meta[name="csrf-token"]');
$(document).ready(function () {
    $('#loading').show();
    let output= '';
    axios.get(location.origin +'/ajax/admin/gettags')
        .then(function (response) {
            for (const tag of response.data.tags) {
                output += `
                   <tr id="`+tag.id+`">
                        <td>`+tag.id+`</td>
                       <td>`+tag.name+`</td>
                       </td>
                              <td>
                                  <button name="`+tag.id+`" class="delete btn btn-danger">
                                        Delete
                                  </button>
                               </td>
                        </tr> `;
            }

            $('#listTag').append(output);
        })
        .then(function () {
            $('#loading').removeAttr("style").hide();
        })



    $("#submit").click(function(event) {
        event.preventDefault();
        let name = $("#tag").val();
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        axios.post(location.origin +'/ajax/admin/newtag',{
            name
        })
            .then(function (response) {
                let tag = response.data.tag;
                output = `
                   <tr id="`+tag.id+`">
                       <td>`+tag.id+`</td>
                       <td>`+tag.name+`</td>

                       </td>
                              <td>
                                  <button name="`+tag.id+`" class="delete btn btn-danger">
                                        Delete
                                  </button>
                               </td>
                        </tr> `;
                $('#newTagForm').trigger('reset');
                $('#listTag').prepend(output);
            })
            .catch(function (error) {
                alert(error.response.data.status);
                $('#newTagForm').trigger('reset');
            })
    });


    jQuery(document).on('click',".delete",function () {
        if (confirm(" Are you sure ?")) {
            tag_id = this.name;
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            axios.delete(location.origin +'/ajax/admin/deletetag',{
                params: {
                    id: tag_id
                }
            })
                .then(function (response) {
                    $("tr#"+tag_id+"").remove();
                })
                .catch(function (error) {
                    console.log(error.response.data.status);
                })
        }
    });
});


