function updateClock( )
{
    var currentTime = new Date( );
    var currentHours = currentTime.getHours( );
    var currentMinutes = currentTime.getMinutes( );
    var currentSeconds = currentTime.getSeconds( );

    currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
    currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
	var timeOfDay = (currentHours < 12) ? "AM" : "PM";

    currentHours = (currentHours > 12) ? currentHours - 12 : currentHours;

    currentHours = (currentHours == 0) ? 12 : currentHours;
	if(parseInt(currentHours)<=10) currentHours='0'+currentHours;
    var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

    $("#clock").html(currentTimeString);

    var day = getDayName(currentTime.getDay());
    var date = currentTime.getDate();
    var month = getMonthName(currentTime.getMonth());
    var year = currentTime.getFullYear();

    var currentDateString = day + ", " + month + " " + date + ", " + year;

    $("#date").html(currentDateString);

}

function getDayName(day) {
    var weekday = new Array(7);
    weekday[0] = "Sun";
    weekday[1] = "Mon";
    weekday[2] = "Tue";
    weekday[3] = "Wed";
    weekday[4] = "Thu";
    weekday[5] = "Fri";
    weekday[6] = "Sat";
    var name = weekday[day];
    return name;
}
function getMonthName(month) {
    var month_array = new Array();
    month_array[0] = "Jan";
    month_array[1] = "Feb";
    month_array[2] = "Mar";
    month_array[3] = "Apr";
    month_array[4] = "May";
    month_array[5] = "Jun";
    month_array[6] = "Jul";
    month_array[7] = "Aug";
    month_array[8] = "Sep";
    month_array[9] = "Oct";
    month_array[10] = "Nov";
    month_array[11] = "Dec";
    var name = month_array[month];
    return name;
}

$(document).ready(function()
{
    setInterval('updateClock()', 1000);

    
});

