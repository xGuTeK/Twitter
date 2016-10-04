$(function(){
    $.ajax({
        url: "index.php?act=registerStepTwo",
        type: "GET",
        success: function (data) {
            $('<div></div>').appendTo('body')
                .html(data)
                .dialog({

                    modal: true,
                    show: {effect: 'fade', duration: 500},
                    hide: {effect: 'fade', duration: 1000},
                    resizable: false,
                    draggable: false,
                    dialogClass: '',
                    open: function (event, ui) {
                        $(".ui-widget-overlay").css({
                            opacity: 0.90,
                            filter: "Alpha(Opacity=0)",
                            backgroundColor: "black"
                        });
                        $(this).siblings('.ui-dialog-titlebar').remove();
                        $(this).css('overflow', 'hidden');
                        $(this).css('left', '0px');
                    },
                    position: {my: "center top", at: "center top+75"}
                });
        }

    });
});