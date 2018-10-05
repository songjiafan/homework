$('.search').on('click', function () {
    var url = 'question/index?title=' + $('.title').val()
    location.href = url
});

$('.search-answer').on('click', function () {
    var url = 'student/index?title=' + $('.title').val()
    location.href = url
});

$('.add').on('click', function () {
    $('#add_question').modal({
        relatedTarget: this,
        onConfirm: function() {
            var select_answer = $("input[name='0']:checked").val() + ',' +
                $("input[name='1']:checked").val() + ',' +
                $("input[name='2']:checked").val() + ',' +
                $("input[name='3']:checked").val() + ',' +
                $("input[name='4']:checked").val() + ',' +
                $("input[name='5']:checked").val() + ',' +
                $("input[name='6']:checked").val() + ',' +
                $("input[name='7']:checked").val() + ',' +
                $("input[name='8']:checked").val() + ',' +
                $("input[name='9']:checked").val();

            var select_content = $("#select_content_0").val() + ';' +
                $("#select_content_1").val() + ';' +
                $("#select_content_2").val() + ';' +
                $("#select_content_3").val() + ';' +
                $("#select_content_4").val() + ';' +
                $("#select_content_5").val() + ';' +
                $("#select_content_6").val() + ';' +
                $("#select_content_7").val() + ';' +
                $("#select_content_8").val() + ';' +
                $("#select_content_9").val();

            var content_question = $('#question_title_0').val() + ';' + $('#question_title_1').val();
            var start_time = $('.start_time').val();
            var end_time = $('.end_time').val();
            var title = $('#question_title').val();
            var str = '';
            for(var i = 0; i < 10; i++) {
                str = str + $(".select-answer-" + i + "-A").val() + ';' + $(".select-answer-" + i + "-B").val() + ';' + $(".select-answer-" + i + "-C").val() + ';' + $(".select-answer-" + i + "-D").val() + '|'
            }
            str = str.substring(0, str.length - 1)
            $.post('question/add', {
                'select_content': select_content,
                'select_answer': select_answer,
                'select_question': str,
                'title': title,
                'content_question': content_question,
                'start_time': start_time,
                'end_time': end_time
            }, function(res){
                if(res.code){
                    alert(res.message)
                } else {
                    alert(res.message);
                    window.location.reload()
                }
            }, 'json')
        }
    });
});
$('.answer').on('click', function () {
    var id = $(this).attr('data-id')
    $('#add_question_' + id).modal({
        relatedTarget: this,
        onConfirm: function() {
            var select_answer = $("input[name='0']:checked").val() + ',' +
                $("input[name='1']:checked").val() + ',' +
                $("input[name='2']:checked").val() + ',' +
                $("input[name='3']:checked").val() + ',' +
                $("input[name='4']:checked").val() + ',' +
                $("input[name='5']:checked").val() + ',' +
                $("input[name='6']:checked").val() + ',' +
                $("input[name='7']:checked").val() + ',' +
                $("input[name='8']:checked").val() + ',' +
                $("input[name='9']:checked").val();


            var subjective = $('#question_title_' + id + '_0').val() + ';' + $('#question_title_' + id + '_0').val()
            $.post('question/answer', {
                'id': id,
                'select_content': select_answer,
                'subjective': subjective,
            }, function(res){
                if (res.code) {
                    alert(res.message);
                } else {
                    alert(res.message);
                    window.location.reload()
                }
            }, 'json')
        }
    });
});
$('.del').on('click', function () {
    $.get('question/del', {'id': $(this).attr('data-id')}, function (res) {
        if(res.code){
            alert(res.message)
        } else {
            alert(res.message);
            window.location.reload()
        }
    }, 'json')
})