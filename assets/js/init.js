/**
 * Created by Dani on 01.06.2017.
 */
$(document).ready(function () {


    $('.carousel').carousel({
        interval: 2000
    })



    $('#input-search').on('keyup keydown paste cut input focus', function () {
        var input_search = $("#input-search").val();
        $("#block-search-result").hide();

        if (input_search.length >= 3) {
            $.ajax({
                type: "POST",
                url: "search.php",
                data: "q=" + input_search,
                dataType: "html",
                cache: false,
                success: function (data) {
                    if ($("#input-search").val() == input_search) {
                        $('#block-search').css('display', 'block');
                        $("#block-search-result").show();

                        $("#list-search-result").html(data);
                    }

                }
            });

        } else {
            $("#block-search-result").hide();
        }

    });


    var refresh = false;
    $(window).on("beforeunload", function (event) {
        var msg = "Do you really want to leave the website?";
        if ($(event.target.activeElement).is("a") || $(event.target.activeElement).is("button") || refresh === true) {
            return;
        }
        return msg;
    });


    $(window).keydown(function (event) {
        //F5 or Ctrl+R
        if (event.keyCode == 116 || ( event.ctrlKey && event.keyCode == 82 ))
            refresh = true;
    });


    $('#inputSearchComment').click(function () {
        var input_search = $("#comId").val();
        $("#result-search").empty();
        $.ajax({
            type: "POST",
            url: "app/approveComment.php",
            data: {comId: input_search},
            dataType: "html",
            cache: false,
            success: function (data) {
                if (data != 'empty') {
                    $("#result-search").empty();

                    var str = "<div class=\"form-group\"> <textarea rows=\"10\" id=\"area\" type=\"text\" class=\"form-control\" name=\"textNews\">" + data + "</textarea></div>";
                    $("#result-search").append(str);
                    $("#result-search").append("<button id=\"editComment\" class=\"btn btn-default\">Edit</button>");
                    editComment();

                } else {
                    $("#result-search").append('Nothing found.');

                }
                //$("#result-search").html(data);

            }
        });


    });

    function editComment() {

        $('#editComment').click(function () {

            var text = $("#area").val();
            var id = $("#comId").val();
            $.ajax({
                type: "POST",
                url: "app/editComment.php",
                data: {comText: text, comId: id},
                dataType: "html",
                cache: false,
                success: function (data) {
                    $("#result-search").empty();
                    $("#result-search").append('Done!');

                }

            });

        });

    }

    $('#approveComments').click(function () {

        var selected = [];
        $('#checkboxes input:checked').each(function () {
            selected.push($(this).attr('value'));
        });

        $.ajax({
            type: "POST",
            url: "app/approveComment.php",
            data: {selected: selected},
            dataType: "html",
            cache: false,
            success: function (data) {

                location.reload();
            }
        });


    });

    setInterval(function update() {
        if($('#overall').length && $('#current').length)
        {
            var overall = parseInt($('#overall').html());
            var current = parseInt($('#current').html());
            var id = $('#news_id').val();

            $('#current').html(Math.floor(Math.random()*(5-0+1)+0));

            $('#overall').html( overall + current);
            $.ajax({
                type: "POST",
                url: "app/update.php",
                data: {red: $('#overall').html(),id: id },
                dataType: "html",
                cache: false,
                success: function (data) {        console.log(data);


                }
            });
        }


    }, 3000);


});