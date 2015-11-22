$(function(){
	$.nette.init();
	
	$( "#frm-newTrainForm-dateTrain" ).datepicker();

	$("#main #right .trainList").on('click', function(){
		$(this).find('.trainContent').toggle();
	});
});
