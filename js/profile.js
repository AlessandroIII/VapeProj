$('#modifica_dati_btn').click( function(){
	$('#myTabContent').slideToggle();
	$('#updateDatiTab').slideToggle();
	$('#button_row').slideToggle();
});
$('#annulla').click(function(){
	$('#myTabContent').slideToggle();
	$('#updateDatiTab').slideToggle();
	$('#button_row').slideToggle();
});
$('#modifica').click(function(){
	var psw, conferma_psw;
	psw = $('#password').val();
	conferma_psw = $('#conferma_password').val();
	if(psw != "" && conferma_psw != ""){
		if(((psw != conferma_psw) && ((psw != null && conferma_psw != null)))){
			alert("Password troppo corta, invalida o non combacianti");
			$('#password').val("");
			 $('#conferma_password').val("");
		}else{
			$('#modifica_dati').submit();
		}
	}
	$('#modifica_dati').submit();
});

