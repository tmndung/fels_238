$( document ).ready(function() {
    $('.category').mouseenter(function () {
        $('.category-subcategory').show();
        $('.category-li').mouseleave(function () {
            $('.category-subcategory').hide();
        });
    });
    $('#view-more1').click(function(event) {
        $('.drop1').toggle("slow", function() {
            // Animation complete.
        });
        if ($(this).text() == 'View More') {
            $(this).text('Close');
        } else {
            $(this).text('View More');
        }
    });
    $('#view-more2').click(function(event) {
        $('.drop2').toggle("slow", function() {
            // Animation complete.
        });
        if ($(this).text() == 'View More') {
            $(this).text('Close');
        } else {
            $(this).text('View More');
        }
    });
    if ($('#info-errors').length){
        setTimeout(function(){
            $('#info-errors').css('display', 'none');
        }, 5000);
    }
    $('#edit-password').click(function(event) {
        var id = $(this).attr('id');
        if(id == 'edit-password') {
            $(this).attr('class', 'actived');
            $('#edit-user').attr('class', '');
            $('.edit-user').css('display', 'none');
            $('.edit-password').css('display', 'block');
        }
    });
    $('#edit-user').click(function(event) {
        var id = $(this).attr('id');
        if(id == 'edit-user') {
            $(this).attr('class', 'actived');
            $('#edit-password').attr('class', '');
            $('.edit-user').css('display', 'block');
            $('.edit-password').css('display', 'none');
        }
    });
    $('.btn-unfollow').click(function(event) {
        var id = $(this).attr('id');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/profile/unfollow',
            type: 'POST',
            dataType:"json",
            data: {
                id:id
            },
            success: function( data ) {
                if (data.success) {
                    $('#info-errors').css('display', 'block');

                    setTimeout(function(){
                        $('#info-errors').css('display', 'none');
                    }, 5000);

                    var classInfo = $('#info-errors').attr('class');
                    $('#info-errors').attr('class', classInfo + ' alert alert-success');
                    $('#info-errors').html(data.success);
                    $('#li'+id).css('display', 'none');

                } else {
                    $('#info-errors').css('display', 'block');

                    setTimeout(function(){
                        $('#info-errors').css('display', 'none');
                    }, 5000);

                    var classInfo = $('#info-errors').attr('class');
                    $('#info-errors').attr('class', classInfo + ' alert alert-danger');
                    $('#info-errors').html(data.error);
                }
            }
        });
    });
    $('.btn-block-follow').click(function(event) {
        var id = $(this).attr('id');
        var classAttr = $('#'+id).attr('class');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/profile/blockfollow',
            type: 'POST',
            dataType:"json",
            data: {
                id:id
            },
            success: function( data ) {
                if (data.success) {
                    if (classAttr == 'btn-follow btn-follow-small btn-block-follow') {
                        $('#'+id).attr('class', 'btn-follow btn-block-follow');
                        $('#'+id).text(data.unblock);
                    } else {
                        $('#'+id).attr('class', 'btn-follow btn-follow-small btn-block-follow');
                        $('#'+id).text(data.block);
                    }
                    $('#info-errors').css('display', 'block');

                    setTimeout(function(){
                        $('#info-errors').css('display', 'none');
                    }, 5000);

                    var classInfo = $('#info-errors').attr('class');
                    $('#info-errors').attr('class', classInfo + ' alert alert-success');
                    $('#info-errors').html(data.success);
                } else {
                    $('#info-errors').css('display', 'block');

                    setTimeout(function(){
                        $('#info-errors').css('display', 'none');
                    }, 3000);

                    var classInfo = $('#info-errors').attr('class');
                    $('#info-errors').attr('class', classInfo + ' alert alert-danger');
                    $('#info-errors').html(data.error);
                }
            }
        })
    });
});
$(document).ready(function() {
    $('.btn-next').click(function (event) {
        var answered = $('.btn-next').attr('actived') ? 1 : 0;
        var testId = $('.content-test').attr('tid');
        var questionId = $('.content-question').attr('qid');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: route('elearning.test.show', testId),
            type: 'POST',
            data: {
                answered: answered,
                questionId: questionId
            },
            success: function success(data) {
                $('.btn-next').removeAttr('actived');
                $('.wrapper-all').html(data);
            }
        });

        return false;
    });
    $('.choose-answer-test').click(function(event) {
        $('.btn-next').attr('actived', 'actived');
        $('.choose-answer-test').off("click");
        var id = $('.answer-test').attr('id'); //lay id question
        var answerId = $(this).attr('id'); // lay id answer nguoi dung chon
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: route('elearning.test.answercorrect'),
            type: 'POST',
            dataType: "json",
            data: {
                id: id,
                answerId: answerId
            },
            success: function( data ) {
                if (answerId == data.correctId) {
                    $('.wrapper-action-test').css('background', '#bff199');
                    $('.btn-next a').css({
                        'background': '#65ab00',
                        'color': '#FFF',
                        'border': '2px solid #FFF'
                    });
                    $('.btn-next a').text('Next');
                    $('li#' + answerId).addClass('correct');
                    $('#wrong-answer').css('display', 'none');
                    $('#right-answer').css('display', 'block');
                } else {
                    $('.wrapper-action-test').css('background', '#ffd3d1');
                    $('.btn-next a').css({
                        'background': '#e70800',
                        'color': '#FFF',
                        'border': '2px solid #FFF'
                    });
                    $('li#' + answerId).addClass('wrong');
                    $('li#' + data.correctId).addClass('correct');
                    $('#wrong-answer').css('display', 'block');
                    $('#right-answer').css('display', 'none');
                    $('.btn-next a').text('Next');
                }
            }
        })
    });
});
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}); 

$(document).ready(function () {
    $('.filter-word').click(function () {
        var role = $(this).attr('role');
        var course_id = $(this).attr('courseId');
        var lesson_id = $('#select-filter-word option:selected').val();
        
        $.ajax({
            method: 'POST',
            url: route('filterWordlist'),
            data: {
                course_id: course_id, 
                role: role, 
                lesson_id: lesson_id
            },
            success: function (data) {
                $('#wordlist-content').html(data);
            },
        });
    });

    $('#select-filter-word').change(function () {
        var lesson_id = $(this).children('option:selected').val();
        var role = $('.filter-wordlist ul .active .filter-word').attr('role');
        var course_id = $('.filter-wordlist ul .active .filter-word').attr('courseId');

        $.ajax({
            method: 'POST',
            url: route('filterWordlist'),
            data: {
                course_id: course_id, 
                role: role, 
                lesson_id: lesson_id
            },
            success: function (data) {
                $('#wordlist-content').html(data);
            },
        });
    });
});

$(document).ready(function() {
    $('#search-text').keyup(function(event) {
        var search = $(this).val();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: route('elearning.search'),
            type: 'POST',
            data: {
                search:search
            },
            success: function( data ) {
                $('.content-search').html(data);
            }
        });
    });
    $('.content-search').mouseleave(function(event) {
        $('.content-search').html('');
    });
});

$(document).ready(function () {
    $('.btn-lesson').click(function () {
        var lessonId = $(this).attr('lesson');
        var courseId = $(this).attr('course');
        var animate = $(this).attr('animate');
        $.ajax({
            method: 'POST',
            url: route('changeLesson'),
            data: {
                lesson_id: lessonId,
                course_id: courseId,
                animate: animate,
            },
            success: function (data) {
                $('.lesson-content').html(data);
            },
        });

        return false;
    });
});


$(document).ready(function () {
    $('#next-lesson').click(function () {
        var lessonId = $(this).attr('lesson');
        var courseId = $(this).attr('course');
        var progress = $('#progress-learning').attr('progress') 
        var offsetProgress = $(this).attr('offsetProgress');
        $.ajax({
            method: 'POST',
            url: route('learning'),
            data: {
                course_id: courseId,
                lesson_id: lessonId,
                progress: progress,
                offsetProgress: offsetProgress,
            },
            success: function (data) {
                $('.learning-container').html(data);
            },
        });
        
        return false;
    });
});

$(document).ready(function () {
    $('#option-quit').click(function () {
        var msg = $(this).attr('message');
        if (confirm(msg)) {
            $('#quit-course-form').submit();
        }

        return false;
    });

    $('#option-restart').click(function () {
        var msg = $(this).attr('message');
        if (confirm(msg)) {
            $('#restart-course-form').submit();
        }

        return false;
    });
});

$(document).ready(function () {
    $('#play-word-audio').click(function () {
        var audio = document.getElementById("listent-audio");
        audio.autoplay = true;
        audio.load();
    });
});

$(document).ready(function() {
    $('.show-more').click(function(event) {
        var nameOld = $('#icon-more').attr('name');
        var classOld = $('#icon-more').attr('class');
        $(this).parent().find('.displaynone').toggle(500, function() {
            $('#icon-more').attr('name', classOld);
            $('#icon-more').attr('class', nameOld);
        });
        
        return false;
    });
    $('.show-more-follow').click(function(event) {
        var nameOld = $(this).children('#icon-more-li').attr('name');
        var classOld = $(this).children('#icon-more-li').attr('class');
        $(this).children('#icon-more-li').attr('name', classOld);
        $(this).children('#icon-more-li').attr('class', nameOld);
        $(this).parent().parent().find('.displaynone').toggle(500);
        
        return false;
    });
});


$(document).ready(function() {
    $('.btn-next-practice').click(function (event) {
        var answered = $('.btn-next-practice').attr('actived') ? 1 : 0;
        var testId = $('.content-test').attr('tid');
        var questionId = $('.content-question').attr('qid');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: route('elearning.practice.show', testId),
            type: 'POST',
            data: {
                answered: answered,
                questionId: questionId
            },
            success: function success(data) {
                $('.btn-next-practice').removeAttr('actived');
                $('.wrapper-all').html(data);
            }
        });

        return false;
    });
    $('.choose-answer-practice').click(function(event) {
        $('.btn-next-practice').attr('actived', 'actived');
        $('.choose-answer-practice').off("click");
        var id = $('.answer-test').attr('id'); //lay id question
        var answerId = $(this).attr('id'); // lay id answer nguoi dung chon
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: route('elearning.test.answercorrect'),
            type: 'POST',
            dataType: "json",
            data: {
                id: id,
                answerId: answerId
            },
            success: function( data ) {
                if (answerId == data.correctId) {
                    $('.wrapper-action-test').css('background', '#bff199');
                    $('.btn-next-practice a').css({
                        'background': '#65ab00',
                        'color': '#FFF',
                        'border': '2px solid #FFF'
                    });
                    $('.btn-next-practice a').text('Next');
                    $('li#' + answerId).addClass('correct');
                    $('#wrong-answer').css('display', 'none');
                    $('#right-answer').css('display', 'block');
                } else {
                    $('.wrapper-action-test').css('background', '#ffd3d1');
                    $('.btn-next-practice a').css({
                        'background': '#e70800',
                        'color': '#FFF',
                        'border': '2px solid #FFF'
                    });
                    $('li#' + answerId).addClass('wrong');
                    $('li#' + data.correctId).addClass('correct');
                    $('#wrong-answer').css('display', 'block');
                    $('#right-answer').css('display', 'none');
                    $('.btn-next-practice a').text('Next');
                }
            }
        })
    });
});

$(document).ready(function () {
    var audio = document.getElementById("listent-audio");
    if (audio) {
        audio.autoplay = true;
        audio.load();
    }
});

$(document).ready(function () {
    $('#review-word').click(function () {
        var msg = $(this).attr('message');
        if (confirm(msg)) {
            $('#form-review-word').submit();
        }
        
        return false;
    });

    $('#review-next-word').click(function () {
        var lessonId = $(this).attr('lesson');
        var courseId = $(this).attr('course');
        var progress = $('#progress-learning').attr('progress') 
        var offsetProgress = $(this).attr('offsetProgress');
        var role = $(this).attr('role');
        $.ajax({
            method: 'POST',
            url: route('reviewing.word'),
            data: {
                course_id: courseId,
                lesson_id: lessonId,
                progress: progress,
                offsetProgress: offsetProgress,
                role: role,
            },
            success: function (data) {
                $('.learning-container').html(data);
            },
        });
        
        return false;
    });
});
