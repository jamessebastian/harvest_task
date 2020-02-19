
$(document).ready(function() {

    $(".js-example-tags").select2({
        tags: true
    });
    $('.js-example-basic-multiple').select2();

});
// function setMaxDateToCurrentDate() {
// 	var todaysDate = new Date();
// 	var year = todaysDate.getFullYear();
// 	var month = ("0" + (todaysDate.getMonth() + 1)).slice(-2);
// 	var day = ("0" + todaysDate.getDate()).slice(-2);
// 	var maxDate = year + "-" + month + "-" + day; // Results in "YYYY-MM-DD" for today's date
//
// 	document.getElementById("date").max = maxDate;
// }
