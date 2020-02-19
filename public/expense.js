$("#addExpenseForm").hide();
function showForm() {
    $("#addExpenseForm").show();
    $("#addExpenseButton").attr("disabled", true);
}
function hideForm() {
    $("#addExpenseForm").hide();
    $("#addExpenseButton").attr("disabled", false);
}
