$('#createUser').submit(function (e) {
    e.preventDefault();
    $('#createUserBTN').prop("disabled",true);
    $.ajax({
        url: 'assets/create_user.php',
        method: 'POST',
        data: $('#createUser').serialize()
    }).done(function(data){
        $('#createUserBTN').prop("disabled",true);
        $('#createBot').trigger("reset");
        $('#newuser').modal('hide');
        if (data === "success"){
            smnswal({
                title: "Da ist was neues!",
                html: "Der Nutzer wurde erstellt und hat per E-Mail seine Anmeldedaten erhalten.<br><small>Es ist sehr wahrscheinlich das die EMail im SPAM Ordner landet</small>",
                type: "success"
            }).then(function() {
                window.location.reload();
            });
        } else {
            smnswal({
                title: "Das läuft nicht so wie geplant",
                text: "Leider gab es einen Fehler beim erstellen des Botes.",
                type: "error"
            })
        }
    });
});

$('.do-edituser').click(function () {
    var id = $(this).data('user-id');
    $.ajax({
        url: 'assets/edit_user.php',
        method: 'POST',
        data: {id: id}
    }).done(function(data){
        if (data !== "error"){
            $('#userinfocontent').html(data);
            $('#userinfo').modal('toggle');
        } else {
            smnswal({
                title: "Das läuft nicht so wie geplant",
                text: "Leider gab es einen Fehler beim erstellen des Nutzers.",
                type: "error"
            })
        }
    });
});

$(document).on('submit','#userinfoform',function (e) {
    e.preventDefault();
    $.ajax({
        url: 'assets/save_user.php',
        method: 'POST',
        data: $('#userinfoform').serialize()
    }).done(function(data){
        if (data === "success"){
            smnswal({
                title: "Erfolgreich gespeichert",
                text: "Das Nutzerprofil wurde aktualisiert",
                type: "success"
            }).then(function() {
                window.location.reload();
            });
        } else {
            smnswal({
                title: "Das läuft nicht so wie geplant",
                text: "Leider gab es einen Fehler beim bearbeiten des Nutzers.",
                type: "error"
            })
        }
    });
});

$(document).on('click','.do-resetuserpw',function (e) {
    var id = $(this).data('user-id');
    $.ajax({
        url: 'assets/reset_pw.php',
        method: 'POST',
        data: {id: id}
            }).done(function(data){
                console.log(data);
                if (data === "success"){
                    smnswal({
                        title: 'Passwort zurückgesetzt',
                        text: 'Der Nutzer hat ein neues Passwort per E-Mail erhalten',
                    }).then(function() {
                        window.location.reload()
                    });
                } else {
                    smnswal({
                        title: "Das läuft nicht so wie geplant",
                        text: "Leider gab es einen Fehler beim zurücksetzten des Passworts",
                        type: "error"
                    });
                }
            });

});

$(document).on('click','.do-deleteuser',function (e) {
    var id = $(this).data('user-id');
    smnswal({
        title: 'User Löschen',
        text: 'Du löscht damit den Nutzer und alle von seinen Bots',
        showCancelButton: true,
        confirmButtonText: 'Löschen',
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: 'assets/delete_user.php',
                method: 'POST',
                data: {userid: id}
            }).done(function(data){
                if (data === "success"){
                    smnswal({
                        title: 'Nutzer gelöscht',
                        text: 'Der Nutzer und alle seine Bots wurde gelöscht',
                    }).then(function() {
                        window.location.reload()
                    });
                } else {
                    smnswal({
                        title: "Das läuft nicht so wie geplant",
                        text: "Leider gab es einen Fehler beim löschen des Nutzers",
                        type: "error"
                    });
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
});

$(document).ready(function() {
    $('#userlist').DataTable({
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/German.json"
        },
        "aoColumnDefs": [
            { "bSortable": false, "aTargets": [1,2,3] }
        ]
    });
} );