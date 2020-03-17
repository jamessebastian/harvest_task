$(document).ready(function() {
    $('.alert').hide();
    $("body").on("click", ".delete", function (e) {
        uuid = $(e.currentTarget).data("uuid");
        hideElement = $(e.currentTarget).parent().parent().parent();
        $("#exampleModalLabel").text("Are you sure you want to delete " + $(e.currentTarget).data("client-name"));

        //console.log( e.currentTarget.getAttribute("data-id").toString());
        //console.log(e.currentTarget.getAttribute("data-id")==$(e.currentTarget).data("id"));
    });


    $(document).on('click','.pagination a',function (e) {
        e.preventDefault();
        url = $(this).attr('href');

        params = getUrlParams(url);

        ajax('POST',
            'clients/ajaxIndex',
            {
                "_token": token,
                "search":params['search'],
                "sort":params['sort'],
                "order":params['order'],
                "page":params['page']
            },
            (data) => {
                currentPageCount = data.currentPageCount;
                $("#tableWrapper").html(data.html);
                urlToPush = "clients?search="+params['search']+"&sort="+params['sort']+"&order="+params['order']+"&page="+params['page'];
                urlToPush = urlToPush.split("undefined").join("");
                window.history.pushState("", "", urlToPush);
            }
        );

    });






    $(document).on('click','#nameSort',function () {

        ajax('POST',
            'clients/ajaxIndex',
            {
                "_token": token,
                "search":$("#searchItem").val(),
                "sort":'name',
                "order":nameSortOrder,
            },
            (data) => {
                currentPageCount = data.currentPageCount;
                $("#tableWrapper").html(data.html);
                window.history.pushState("", "", "clients?search="+$("#searchItem").val()+"&sort=name&order="+nameSortOrder);
        }
        );
        if(nameSortOrder === 'asc') {
            nameSortOrder = 'desc';
        } else {
            nameSortOrder = 'asc';
        }
        currencySortOrder = 'asc';
    });

    $(document).on('click','#currencySort',function () {
        ajax('POST',
            'clients/ajaxIndex',
            {
                "_token": token,
                "search":$("#searchItem").val(),
                "sort":'currency',
                "order":currencySortOrder,
            },
            (data) => {
                currentPageCount = data.currentPageCount;
                window.history.pushState("", "", "clients?search="+$("#searchItem").val()+"&sort=currency&order="+currencySortOrder);
                $("#tableWrapper").html(data.html);
        }
        );
        if(currencySortOrder === 'asc') {
            currencySortOrder = 'desc';
        } else {
            currencySortOrder = 'asc';
        }
        nameSortOrder = 'asc';
    });








    $("#yes").on("click", function(){

        ajax('POST',
            '/clients/'+uuid,
            {'id':uuid,
                "_token": token,
                "_method":"DELETE"
            },
            (data) => {
                //  hideElement.hide();
                $('.alert').show();
                $('.alert').text(data.msg);
                setTimeout(()=>{$('.alert').hide();}, 2000);
                windowLocation = new URL(window.location);
                if(currentPageCount == 1) {
                    page = windowLocation.searchParams.get('page') - 1;
                    urlToPush = "clients?search="+windowLocation.searchParams.get('search')+"&sort="+windowLocation.searchParams.get('sort')+"&order="+windowLocation.searchParams.get('order')+"&page="+page;
                    window.history.pushState("", "", urlToPush);
                } else {
                    page = windowLocation.searchParams.get('page');
                }
                ajax('POST',
                    'clients/ajaxIndex',
                    {
                        "_token": token,
                        "search":windowLocation.searchParams.get('search'),
                        "sort":windowLocation.searchParams.get('sort'),
                        "order":windowLocation.searchParams.get('order'),
                        "page":page,
                    },
                    (data) => {
                        currentPageCount = data.currentPageCount;
                        $("#tableWrapper").html(data.html);
                    }
                );
            }
        );



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
            window.history.pushState("", "", "clients?search="+$("#searchItem").val());
        }
    );

    return false;
}
