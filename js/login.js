$('#registrazione_btn').click(function(){
	var psw, conferma_psw;
	psw = $('#reg_psw').val();
	conferma_psw = $('#reg_conferma').val();
	if(((psw != conferma_psw) && ((psw != null && conferma_psw != null)))){
		alert("Password troppo corta, invalida o non combacianti");
		$('#reg_psw').val("");
		 $('#reg_conferma').val("");
	}else{
		alert("Registrazione avvenuta con successo");
		$('#register').submit();
	}
});

// $('#to_register').click(function(){
// 	$('#login_div').slideToggle();
// 	$('#register_div').slideToggle();
// })

var eventHandler = function (event) {
    // Only run for iOS full screen apps
    if (('standalone' in window.navigator) && window.navigator.standalone) {
        // Only run if link is an anchor and points to the current page
        if ( event.target.tagName.toLowerCase() !== 'a' || event.target.hostname !== window.location.hostname || event.target.pathname !== window.location.pathname || !/#/.test(event.target.href) ) return;

        // Open link in same tab
        event.preventDefault();
        window.location = event.target.href;
    }
}
window.addEventListener('click', eventHandler, false);