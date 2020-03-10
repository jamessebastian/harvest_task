$(document).ready(function() {

    $("body").on("click", ".delete", function(e) {
        uuid = $(e.currentTarget).data("uuid");
        document.getElementById("projectDelete").action = "/projects/"+uuid;
        $("#exampleModalLabel").text("Are you sure you want to delete " + $(e.currentTarget).data("project-name"));

        //console.log( e.currentTarget.getAttribute("data-id").toString());
        //console.log(e.currentTarget.getAttribute("data-id")==$(e.currentTarget).data("id"));
    });

});
