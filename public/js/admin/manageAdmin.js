let token = document.head.querySelector('meta[name="csrf-token"]');
$(document).ready(function () {
    $('#loading').show();
    let output= '';
    axios.get(location.origin +'/ajax/admin/getadmins')
        .then(function (response) {
            for (const admin of response.data.admins) {
                if (admin.id != admin_id)
                {
                output += `
                   <tr id="`+admin.id+`">
                       <td>`+admin.id+`</td>
                       <td>`+admin.name+`</td>
                       <td>`+admin.email+`</td>
                       </td>
                              <td>
                                  <button name="`+admin.id+`" class="delete btn btn-danger">
                                        Delete
                                  </button>
                               </td>
                        </tr> `;
                }
                else
                    {
                        output += `
                       <tr id="`+admin.id+`">
                       <td>`+admin.id+`</td>
                       <td>`+admin.name+`</td>
                       <td>`+admin.email+`</td>
                       </td>
                              <td>
                                  <button name="`+admin.id+`" class="delete btn btn-danger" disabled>
                                        Delete
                                  </button>
                               </td>
                        </tr> `;
                    }
            }

            $('#listAdmin').append(output);
        })
        .then(function () {
            $('#loading').removeAttr("style").hide();
        })



    $("#submit").click(function (event) {
        event.preventDefault();
        let name = $("#name").val();
        let email =  $("#email").val();
        let password =  $("#password").val();
        let passwordConfirm = $("#passwordConfirm").val();
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        axios.post(location.origin +'/ajax/admin/newadmin',{
                name,
                email,
                password,
                passwordConfirm
        })
            .then(function (response) {
                let admin = response.data.admin;
                output = `
                   <tr id="`+admin.id+`">
                       <td>`+admin.id+`</td>
                       <td>`+admin.name+`</td>
                       <td>`+admin.email+`</td>
                       </td>
                              <td>
                                  <button name="`+admin.id+`" class="delete btn btn-danger">
                                        Delete
                                  </button>
                               </td>
                        </tr> `;
                $('#newAdminForm').trigger('reset');
                $('#listAdmin').prepend(output);
            })
            .catch(function (error) {
                alert('Please check input !');

            })
    });


    jQuery(document).on('click',".delete",function () {
        if (confirm(" Are you sure ?")) {
            admin_id = this.name;
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            axios.delete(location.origin +'/ajax/admin/deleteadmin',{
                params:{
                    admin_id: admin_id
                }
            })
                .then(function (response) {
                $("tr#"+admin_id+"").remove();
            })
                .catch(function (error) {
                    console.log(error);
                })
        }
    });
});


