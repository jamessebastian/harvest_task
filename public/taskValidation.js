
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


function numberValidate(name) {
    if (/^\s*\d+\s*/.test(name)) {
        return true;
    }
    return false;
}


function validate() {
    flag = true;

    if (!requiredValidate( $("#name").val() )) {
        flag = false;
        $("#nameErr").text('The name field is required.');
    } else if (!nameValidate( $("#name").val() )) {
        flag = false;
        $("#nameErr").text('Name should start with a letter.');
    } else {
        $("#nameErr").text('');
    }


    if (!requiredValidate( $("#hourlyRate").val() )) {
        flag = false;
        $("#hourlyRateErr").text('The hourly rate field is required.');
    } else if(!numberValidate( $("#hourlyRate").val() )) {
        flag = false;
        $("#hourlyRateErr").text('The hourly rate must be a number.');
    } else {
        $("#hourlyRateErr").text('');
    }


    return flag;
}













