/*;(function() {
	var call_switch = $('#checkbox6');
	call_switch.on('click', function(event) {
		event.preventDefault();
		$('#please_dissapear').css('display', '');
	});
		
}).call(this);

$('input:checkbox6').click(function() {
    if($(this).is(':checked')) {
      // Stuff to do every *odd* time the element is clicked;
      $('#please_disappear').css.display = block;
    } 
    else {
      // Stuff to do every *even* time the element is clicked;
      $('#please_disappear').css.display = none;
    }
});*/

function phoneClicked(){
	alert("clicked");
	if(document.getElementById('').checked){
		$('#please_disappear').css.display = block;
	}
	else{
		$('#please_disappear').css.display = none;
	}
}