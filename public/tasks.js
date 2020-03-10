$(document).ready(function() {

    $('.alert').hide();
    $("body").on("click", ".delete", function(e) {
        uuid = $(e.currentTarget).data("uuid");
        hideElement = $(e.currentTarget).parent().parent().parent();
        $("#exampleModalLabel").text("Are you sure you want to delete " + $(e.currentTarget).data("task-name"));

        //console.log( e.currentTarget.getAttribute("data-id").toString());
        //console.log(e.currentTarget.getAttribute("data-id")==$(e.currentTarget).data("id"));
    });


});

