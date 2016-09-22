$(function(){
	var textarea = $('.textarea-tweet');
	
	$('.textarea-tweet').on('input', function(event){
		var txt = textarea.val();
		
		if(txt.length <= 140)
			textarea.val(txt.substr(0,140));
		
		if(txt.length <= 47){
			var color = 'green';
		} else if(txt.length <= 94){
			var color = 'yellow';
		} else {
			var color = 'red';
		}
		$('.textarea-tweet').css('border-color', color);
		$('.textarea-count').text(txt.length + ' / 140').css('color', color);
		$('.textarea-count').text(txt.length + ' / 140').css('left', '100px;');
	});


	
	function ConfirmDialog(message, form){
    $('<div></div>').appendTo('body')
                    .html('<div><h3>'+message+'</h3></div>')
                    .dialog({
                        modal: true, title: 'Are You sure to confirm this tweet?', zIndex: 10000, autoOpen: true,
                        width: 'auto', resizable: false,
                        buttons: {
                            Yes: function () {
                                // $(obj).removeAttr('onclick');                                
                                // $(obj).parents('.Parent').remove();

								$.ajax({
									url: "index.php?act=tweet",
									type: "POST",
									data: new FormData(form),
									contentType: false,
									cache: false,
									processData:false,
									success: function(data)
									{
										alert(data);
									}
								});
                                $(this).dialog("close");
                            },
                            No: function () {
                                $(this).dialog("close");
                            }
                        },
                        close: function (event, ui) {
                            $(this).remove();
                        }
                    });
    };

	$( "#newTweetForm" ).submit(function( e ) {
		e.preventDefault();
		var text = $('.textarea-tweet').val();
		if(text.length >= 10 && text.length <= 140 ) {
			ConfirmDialog(text, e.target);
		}
	});


	
});