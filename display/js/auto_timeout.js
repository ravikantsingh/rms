$(document).ready(function () {
    var timer = setInterval(idleSessout, 600000); //assign timer to a variable

    $(window).bind('focus', function ()
    {
        clearInterval(timer); //clear interval
        timer = setInterval(idleSessout, 600000); //start it again
    });
});

function idleSessout()
{
    var base_url = $("#base_url").val();
    //get the last page load time and current server time
    var post_path = base_url + "time/check_time_out";
    jQuery.post(post_path, {}, function (data)
    {
        if (data == "expired") {
            document.location.href = base_url + "login/auto_logout";
        }
    });
}