$(function(){
	$.nette.init();
	
	$( "#datepicker" ).datepicker();

	$("#main #right .trainList").on('click', function(){
		$(this).find('.trainContent').toggle();
	});
});
