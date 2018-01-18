$(document).ready(function() {
    var time = $('#progress-bar').attr('time') * 60;
    var timing = 0;
    function countDown () {
        var percent = (timing * 100) / time;
        $('#progress-bar').attr('aria-valuenow', percent);
        $('#progress-bar').css('width', percent + '%');
        var minutes = Math.floor((time - Math.round(timing)) / 60);
        var seconds = Math.floor((time - Math.round(timing)) % 60);
        var seconds = seconds >= 10 ? seconds : '0' + seconds;
        $('.display-time-test').text(minutes + " : " + seconds);
        if (timing >= time) {
            var testId = $('.content-test').attr('tid');
            $('body').load(route('elearning.test.result', testId));
        } else {
            timeout = setTimeout(function(){
                timing += 0.1;
                countDown();
            }, 100);
        }
    }
    countDown();
});
