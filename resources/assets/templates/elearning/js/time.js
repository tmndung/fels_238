$(document).ready(function() {
    var timing = 0;
    function time () {
        timeout = setTimeout(function(){
            timing += 1;
            time();
        }, 1000);
        if ($('.displate-time-practice').length) {
            display();
            clearTimeout(timeout);
        }
    }

    function display () {
        var minutes = Math.floor(Math.round(timing) / 60);
        var seconds = Math.floor(Math.round(timing) % 60);
        var seconds = seconds >= 10 ? seconds : '0' + seconds;
        $('.displate-time-practice').text(minutes + ':' + seconds);
    }
    time();
});
