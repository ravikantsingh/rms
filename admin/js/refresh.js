$(document).ready(function () {
    getNotifications();

    var timer = setInterval(getNotifications, 5000); //assign timer to a variable

    $(window).bind('focus', function ()
    {
        clearInterval(timer); //clear interval
        timer = setInterval(getNotifications, 5000); //start it again
    });
});

function getNotifications() {

    var base_url = $("#base_url").val();

    $.ajax({
        url: base_url + "cpadmin/adminHome/inc/post/getNtification.php",
        dataType: "json",
        contentType: "application/json",
        success: function (notifications) {
			alert();
            if (notifications) {
                $.remove_notificator();

                $.each(notifications, function (k, v) {
                    var message = v.message;
                    $.notificator(message, k);
                });
            }
        }
    });
}
