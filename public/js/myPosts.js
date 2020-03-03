$(document).ready(function() {

    $(".statePublic").click(function () {
        post_id = this.name;
        $(".statePublic[name='"+post_id+"']").hide();
       axios
           .get(location.origin +'/ajax/changeState/'+ post_id)
           .then(function (response) {
               $(".statePrivate[name='"+post_id+"']").show();
           });
    });

    $(".statePrivate").click(function () {
        post_id = this.name;
        $(".statePrivate[name='"+post_id+"']").removeAttr("style").hide();
        axios
            .get(location.origin +'/ajax/changeState/'+ post_id)
            .then(function (response) {
                $(".statePublic[name='"+post_id+"']").show();
            });
    });

    $(".deletePost").click(function () {
        if (confirm("Are you sure?")) {
            post_id = this.name;
            axios
                .get(location.origin +'/ajax/deletePost/'+ post_id)
                .then(function (response) {
                    $("div").remove("#post"+post_id);
                });
        }
        return;
    })
});



