const smnswal = Swal.mixin({
    confirmButtonClass: 'btn btn-info',
    cancelButtonClass: 'btn btn-primary',
    buttonsStyling: false,
});


$(document).on('click','.language',function (event) {
    event.preventDefault();
    var lang = $(this).data('lang');
    console.log(lang);
    $.ajax({
        url: 'assets/set_lang.php',
        method: 'POST',
        data: {lang: lang}
    }).done(function(data){
        if (data === "success"){
           window.location.reload();
        } else {
            smnswal({
                title: "Verarbeitungsfehler",
                text: "Leider gab es einen Fehler beim Aktualisieren Deines NxtBOT",
                type: "error"
            })
        }
    });
});