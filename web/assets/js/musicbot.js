$(document).ready(function() {
    $('.volume-slider').on('input', function () {
        $('#volume-display').html(lang['VOLUME']+':'+$(this).val()+'%');
    });
});

$('#connectionsettings').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: 'assets/save_bot.php',
        method: 'POST',
        data: $('#connectionsettings').serialize()
    }).done(function(data){
        if (data === "success"){
            smnswal({
                title: lang['SETTINGS_CHANGED'],
                text: lang['SETTINGS_CHANGED_MESSAGE'],
                type: "success"
            })
        } else {
            smnswal({
                title: lang['ERROR'],
                text: lang['ERROR_MESSAGE'],
                type: "error"
            })
        }
    });
});

$('#audiosettings').submit(function (e) {
    e.preventDefault();
    $.ajax({
        url: 'assets/save_bot.php',
        method: 'POST',
        data: $('#audiosettings').serialize()
    }).done(function(data){
        if (data === "success"){
            $('#currentsong').val($('input[name="streamurl"]').val());
            smnswal({
                title: lang['SETTINGS_CHANGED'],
                text: lang['SETTINGS_CHANGED_MESSAGE'],
                type: "success"
            })
        } else {
            smnswal({
                title: lang['ERROR'],
                text: lang['ERROR_MESSAGE'],
                type: "error"
            })
        }
    });
});

$('.do-botstart').click(function (e) {
    e.preventDefault();
    $('#bot-start').prop("disabled",true);
    var id = $(this).parent().parent().data('bot-id');
    $.ajax({
        url: 'assets/save_bot.php',
        method: 'POST',
        data: {method: 'start',botid: id}
    }).done(function(data){
        if (data === "success"){
            window.location.reload();
        } else {
            $('#bot-start').prop("disabled",false);
            smnswal({
                title: lang['ERROR'],
                text: lang['ERROR_MESSAGE'],
                type: "error"
            });
        }
    });
});

$('.do-botstop').click(function (e) {
    e.preventDefault();
    $('#bot-stop').prop("disabled",true);
    var id = $(this).parent().parent().data('bot-id');
    $.ajax({
        url: 'assets/save_bot.php',
        method: 'POST',
        data: {method: 'stop',botid: id}
    }).done(function(data){
        if (data === "success"){
            window.location.reload();
        } else {
            $('#bot-stop').prop("disabled",true);
            smnswal({
                title: lang['ERROR'],
                text: lang['ERROR_MESSAGE'],
                type: "error"
            });
        }
    });
});

$('.do-playmusic').click(function (e) {
    e.preventDefault();
    var id = $(this).parent().data('bot-id');
    $.ajax({
        url: 'assets/save_bot.php',
        method: 'POST',
        data: {method: 'resume',botid: id}
    }).done(function(data){
        if (data !== "success"){
            smnswal({
                title: lang['ERROR'],
                text: lang['ERROR_MESSAGE'],
                type: "error"
            });
        }
    });
});

$('.do-pausemusic').click(function (e) {
    e.preventDefault();
    var id = $(this).parent().data('bot-id');
    $.ajax({
        url: 'assets/save_bot.php',
        method: 'POST',
        data: {method: 'pause',botid: id}
    }).done(function(data){
        console.log(data);
        if (data !== "success"){
            smnswal({
                title: lang['ERROR'],
                text: lang['ERROR_MESSAGE'],
                type: "error"
            });
        }
    });
});

$('.do-quickplay').click(function (e) {
    e.preventDefault();
    var id = $(this).parent().parent().parent().parent().data('bot-id');
    var url = $(this).data('stream-url');
    var name = $(this).parent().parent().children(":first").text();
    $.ajax({
        url: 'assets/save_bot.php',
        method: 'POST',
        data: {method: 'quickplay',botid: id,streamurl:url}
    }).done(function(data){
        if (data === "success"){
            $('input[name="streamurl"]').val(url);
            $('#currentsong').val(url);
            smnswal({
                title: lang['STATION_CHANGED'],
                html: lang['STATION_CHANGED_MESSAGE'].replace('%station%',name),
                type: "success"
            })
        } else {
            smnswal({
                title: lang['ERROR'],
                text: lang['ERROR_MESSAGE'],
                type: "error"
            });
        }
    });
});

$('.do-botdelete').click(function (e) {
    e.preventDefault();
    var id = $(this).parent().parent().data('bot-id');
    smnswal({
        title: lang['BOT_DELETE'],
        text: lang['BOT_DELETE_CONFIRM'],
        showCancelButton: true,
        confirmButtonText: lang['BOT_DELETE_WORD'],
        showLoaderOnConfirm: true,
        preConfirm: () => {
            $.ajax({
                url: 'assets/save_bot.php',
                method: 'POST',
                data: {method: 'delete',botid: id}
            }).done(function(data){
                if (data === "success"){
                    smnswal({
                        title: lang['BOT_DELETED'],
                        text: lang['BOT_DELETED_SUCCESS'],
                    }).then(function() {
                        window.location.href = 'dashboard.php'
                    });
                } else {
                    smnswal({
                        title: lang['ERROR'],
                        text: lang['ERROR_MESSAGE'],
                        type: "error"
                    });
                }
            });
        },
        allowOutsideClick: () => !Swal.isLoading()
    });
});

$(document).on('click','.do-removeqp',function (e) {
    var id = $(this).data('id');
    $("#qp_h_i_"+id).remove();
});

$('.do-customquickplay').click(function () {
    $.ajax({
        url: 'assets/custom_qp.php',
        method: 'POST',
        data: {method: 'GET'}
    }).done(function(data){
        if (data !== "error"){
            $('#quickplaycustomcontent').html(data);
            $('#quickplaycustom').modal('toggle');
        } else {
            smnswal({
                title: lang['ERROR'],
                text: lang['ERROR_MESSAGE'],
                type: "error"
            })
        }
    });
});

$(document).on('submit','#cqpform',function (e) {
    e.preventDefault();
    $.ajax({
        url: 'assets/custom_qp.php',
        method: 'POST',
        data: $('#cqpform').serialize()
    }).done(function(data){
        if (data === "success"){
            smnswal({
                title: lang['STATION_UPDATED'],
                text: lang['STATION_UPDATED_MESSAGE'],
                type: "success"
            }).then(function() {
                window.location.reload();
            });
        } else {
            smnswal({
                title: lang['ERROR'],
                text: lang['ERROR_MESSAGE'],
                type: "error"
            })
        }
    });
});
