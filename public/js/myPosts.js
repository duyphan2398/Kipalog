$(document).ready(function() {

    $(".statePublic").click(function () {
        post_id = this.name;
        $(".statePublic[name='"+post_id+"']").hide();
        $(".statePrivate[name='"+post_id+"']").show();
       axios.get(location.origin +'/ajax/changeState/'+ post_id);
    });

    $(".statePrivate").click(function () {
        post_id = this.name;
        $(".statePrivate[name='"+post_id+"']").removeAttr("style").hide();
        $(".statePublic[name='"+post_id+"']").show();
        axios.get(location.origin +'/ajax/changeState/'+ post_id);
    });

    $(".deletePost").click(function () {
        if (confirm("Are you sure ?")) {
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



