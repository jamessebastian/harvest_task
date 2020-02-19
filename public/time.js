$("#date").change(function(){
    let str= $("#date").val().replace(/-/g, "/");
    window.location.replace("/time/"+str);
});
