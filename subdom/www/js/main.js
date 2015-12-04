$(function(){
	$.nette.init();
	
	$( "#frm-newTrainForm-dateTrain" ).datepicker({
  		dateFormat: "dd mm yy"
	});

	$("#main #right .trainList p a.trainHeader").on('click', function(){
		$(this).parents('.trainList').find('.trainContent').toggle();
		return false;
	});

	$('<div id="ajax-spinner"></div>').appendTo("body").ajaxStop(function () {
		$(this).hide().css({
			position: "fixed",
			left: "50%",
			top: "50%"
		});
	}).hide();
	// zajaxovatění odkazů provedu takto
	/*$("input[type=submit].ajax").on("click", function (event) {
	    event.preventDefault();

	    $.post(this.href);

	    // zobrazení spinneru a nastavení jeho pozice
	    $("#ajax-spinner").show().css({
	        position: "absolute",
	        left: event.pageX + 20,
	        top: event.pageY + 40
	    });
	});*/
});
