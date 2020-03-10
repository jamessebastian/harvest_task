

function ajax(type , url , data, ajaxSuccessFunction){



    $.ajax({
        type 		: type,
        url 		: url,
        data 		: data,
        dataType 	: 'json',
        success 	: ajaxSuccessFunction,
        error: function(xhr, ajaxOptions, thrownError) {
            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });

}








