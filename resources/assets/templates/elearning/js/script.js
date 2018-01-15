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
