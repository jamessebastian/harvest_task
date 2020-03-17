let validCurrencies = ['INR', 'USD','EUR','AUD','CAD','JPY'];

function nameValidate(name) {
    if (/^(\s*[A-Za-z]\w*\s*)*$/.test(name)) {
        return true;
    }
    return false;
}

function requiredValidate(field) {
    if (field.trim()=="") {
        return false;
    }
    return true;
}

function currencyValidate(currency) {
    if(validCurrencies.includes(currency)) {
        return true;
    }
    return false;
}



function validate() {
    flag = true;

    if (!requiredValidate( $("#clientName").val() )) {
        flag = false;
        $("#clientNameErr").text('The name field is required.');
    } else if (!nameValidate( $("#clientName").val() )) {
        flag = false;
        $("#clientNameErr").text('Name should start with a letter.');
    } else {
        $("#clientNameErr").text('');
    }


    if (!requiredValidate( $("#address").val() )) {
        flag = false;
        $("#addressErr").text('The address field is required.');
    } else {
        $("#addressErr").text('');
    }

    if (!currencyValidate( $("#preferredCurrency").val() )) {
        flag = false;
         $("#currencyErr").text('The selected currency is invalid.');
    } else {
         $("#currencyErr").text('');
    }

    //show alert box
    if(!flag) {
        $('#alertBox').html('<div class="alert alert-danger" role="alert">Please enter the correct values</div>');
    }


    return flag;
}














