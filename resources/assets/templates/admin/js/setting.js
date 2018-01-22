function tokenAjax() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}
$(document).ready(function() {
    $('#checkAll').click(function(event) {
        if ($(this).prop('checked') == true){
            $('.checkwordlist').prop('checked', true);
        } else {
            $('.checkwordlist').prop('checked', false);
        }
    });
    $('#btnDelWordList').click(function(event) {
        var idWordlists = [];
        $('input[name=checkboxWordlist]:checked').each ( function(i) {
            idWordlists[i] = $(this).attr('id');
        });
        tokenAjax();
        $.ajax({
            url: route('admin.wordlist.delete'),
            type: 'post',
            data: {
                idWordlists: idWordlists
            },
            success: function( data ) {
                $('.content-wordlist').html(data);
            }
        });
    });
    $('#selectLesson').change(function(event) {
        var id = $(this).val();
        tokenAjax();
        $.ajax({
            url: route('admin.wordlist.content'),
            type: 'post',
            data: {
                id: id
            },
            success: function( data ) {
                $('.content-wordlist').html(data);
            }
        });
    });
});
$(document).ready(function() {
    $('#checkAll').click(function(event) {
        if ($(this).prop('checked') == true){
            $('.checkboxCategory').prop('checked', true);
        } else {
            $('.checkboxCategory').prop('checked', false);
        }
    });
    $('.sub-checkall').click(function(event) {
        var id = $(this).attr('id');
        if ($(this).prop('checked') == true){
            $('.checkboxCategory' + id).prop('checked', true);
        } else {
            $('.checkboxCategory' + id).prop('checked', false);
        }
    });
    $('.checkboxCategory').click(function(event) {
        if ($(this).prop('checked') == false){
            var parent = $(this).attr('parent');
            $('#' + parent).prop('checked', false);
        }
    });
    $('#btnDelCategory').click(function(event) {
        var idCategories = [];
        $('input[name=checkboxCategory]:checked').each ( function(i) {
            idCategories[i] = $(this).attr('id');
        });
        tokenAjax()
        $.ajax({
            url: route('admin.category.delete'),
            type: 'post',
            data: {
                idCategories: idCategories
            },
            success: function( data ) {
                $('.content-wordlist').html(data);
            }
        });
    });
});

$(document).ready(function() {
    $('.content-wordlist').on('click', '.pagination a',function(event) {
        event.preventDefault();
        $('li').removeClass('active');
        $(this).parent('li').addClass('active');
        var myurl = $(this).attr('href');
        var page=$(this).attr('href').split('page=')[1];
        getData(page);
    });
    function getData(page){
        tokenAjax();
        $.ajax({
            url: route('admin.wordlist.content') +'?page=' + page,
            type: 'post',
            data: {
            },
            success: function success(data) {
                $('.content-wordlist').html(data);
            }
        });
    }
});
