$(document).ready(function() {
    $('.alert').hide();
    $("body").on("click", ".delete", function (e) {
        uuid = $(e.currentTarget).data("uuid");
        hideElement = $(e.currentTarget).parent().parent().parent();
        $("#exampleModalLabel").text("Are you sure you want to delete " + $(e.currentTarget).data("client-name"));

        //console.log( e.currentTarget.getAttribute("data-id").toString());
        //console.log(e.currentTarget.getAttribute("data-id")==$(e.currentTarget).data("id"));
    });

});

function getUrlParams(url) {
    var params = {};
    url.substring(1).replace(/[?&]+([^=&]+)=([^&]*)/gi,
            function (str, key, value) {
                 params[key] = value;
            });
    return params;
}

function searchSubmit(token) {
    //e.preventDefault();
    ajax('POST',
        'clients/ajaxIndex',
        {
            "_token": token,
            "search":$("#searchItem").val()
        },
        (data) => {
            $("#tableWrapper").html(data.html);
        }
    );

    return false;
}
