let token = document.head.querySelector('meta[name="csrf-token"]');
$(document).ready(function () {
    $('#loadingCategory').show();
    $('#loadingTag').show();
    let outputCategories= '';
    let outputTags= '';
    axios.get(location.origin +'/ajax/admin/getcategories')
        .then(function (response) {
            for (const category of response.data.categories) {
                outputCategories += `
                   <tr id="`+category.id+`">
                        <td>`+category.id+`</td>
                       <td>`+category.name+`</td>
                       </td>
                              <td>
                                  <button name="`+category.id+`" class="change down btn btn-danger"  style="width: 140px">
                                        Down
                                  </button>
                               </td>
                        </tr> `;
            }
            $('#loadingCategory').removeAttr("style").hide();
            $('#listCategory').empty().append(outputCategories);
            for (const tag of response.data.tags) {
                outputTags += `
                   <tr id="`+tag.id+`">
                                <td>`+tag.id+`</td>
                                <td>`+tag.name+`</td>
                                 </td>
                              <td>
                                  <button  name="`+tag.id+`" class="change up btn btn-success" style="width: 140px">
                                        Up
                                  </button>
                               </td>
                        </tr> `;
            }
            $('#loadingTag').removeAttr("style").hide();
            $('#listTag').empty().append(outputTags);
        })


    $("#submit").click(function(event) {
        event.preventDefault();
        let name = $("#category").val();
        window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        axios.post(location.origin +'/ajax/admin/newcategory',{
            name
        })
            .then(function (response) {
                let category = response.data.category;
                outputCategories = `
                   <tr id="`+category.id+`">
                       <td>`+category.id+`</td>
                       <td>`+category.name+`</td>

                       </td>
                              <td>
                                  <button name="`+category.id+`" class="change down btn btn-danger"  style="width: 140px">
                                        Down
                                  </button>
                               </td>
                        </tr> `;
                $('#newCatagoryForm').trigger('reset');
                $('#listCategory').prepend(outputCategories);
            })
            .catch(function (error) {
                console.log(error.response.data);
                alert(error.response.data.status);
                $('#newTagForm').trigger('reset');
            })
    });


    jQuery(document)
        .on('click',".change",function () {
            let output = '';
            if ($(this).hasClass('up')) {
                $(this).closest('tr').remove();
            }
            else{
                $(this).closest('tr').remove();
            }
            category_id = this.name;
            console.log(category_id);
            window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
            axios.patch(location.origin +'/ajax/admin/updatecategory',{
                category_id
              })
                .then(function (response) {
                    let  category = response.data.tag;
                    if (category.is_category == 1 ) {
                        output =`
                           <tr id="`+category.id+`">
                               <td>`+category.id+`</td>
                               <td>`+category.name+`</td>

                               </td>
                                      <td>
                                          <button name="`+category.id+`" class="change down btn btn-danger"  style="width: 140px">
                                                Down
                                          </button>
                                       </td>
                                </tr> `;
                        $("#listCategory").prepend(output);
                    }
                    else {
                        output =`
                           <tr id="`+category.id+`">
                               <td>`+category.id+`</td>
                               <td>`+category.name+`</td>

                               </td>
                                      <td>
                                          <button  name="`+category.id+`" class="change up btn btn-success" style="width: 140px">
                                                Up
                                          </button>
                                       </td>
                                </tr> `;
                        $("#listTag").prepend(output);
                    }
                    console.log(category);
                })
                .catch(function (error) {
                    console.log(error.response);
                })
    });
});


