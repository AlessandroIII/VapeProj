if(detectmob()){
	$("#device").val("cell");
} else {
	$("#device").val("pc");	
}

$("#aroma1").change(function(){
	var aroma_selezionato = $('#aroma1').val();
	if(aroma_selezionato > 0){
		if(detectmob()){
			$("#qta_aroma1_cell").slideDown();
		}else{
			$("#qta_aroma1_pc").slideDown();
		}
	}else{
		if(detectmob()){
			$("#qta_aroma1_cell").slideUp();
		}else{
			$("#qta_aroma1_pc").slideUp();

		}
	}
});

$("#aroma2").change(function(){
	var aroma_selezionato = $('#aroma2').val();
	if(aroma_selezionato > 0){
		if(detectmob()){
			$("#qta_aroma2_cell").slideDown();
		}else{
			$("#qta_aroma2_pc").slideDown();
		}
	}else{
		if(detectmob()){
			$("#qta_aroma2_cell").slideUp();
		}else{
			$("#qta_aroma2_pc").slideUp();
		}
	}
});

$("#aroma3").change(function(){
	var aroma_selezionato = $('#aroma3').val();
	if(aroma_selezionato > 0){
		if(detectmob()){
				$("#qta_aroma3_cell").slideDown();
			}else{
				$("#qta_aroma3_pc").slideDown();
			}
		}else{
			if(detectmob()){
				$("#qta_aroma3_cell").slideUp();
			}else{
				$("#qta_aroma3_pc").slideUp();
			}
		}
	}
);

$("#aroma4").change(function(){
	var aroma_selezionato = $('#aroma4').val();
	if(aroma_selezionato > 0){
		if(detectmob()){
				$("#qta_aroma4_cell").slideDown();
			}else{
				$("#qta_aroma4_pc").slideDown();
			}
		}else{
			if(detectmob()){
				$("#qta_aroma4_cell").slideUp();
			}else{
				$("#qta_aroma4_pc").slideUp();
			}
		}
	}
);

$('#prefatto').click(function() {
	if(detectmob()){
		if($("#qta_aroma1_cell").css('display') != 'none' || $("#qta_aroma1_cell").css("visibility") != "hidden"){
			$("#qta_aroma1_cell").slideUp();
		}
		if($("#qta_aroma2_cell").css('display') != 'none' || $("#qta_aroma2_cell").css("visibility") != "hidden"){
			$("#qta_aroma2_cell").slideUp();
		}
		if($("#qta_aroma3_cell").css('display') != 'none' || $("#qta_aroma3_cell").css("visibility") != "hidden"){
			$("#qta_aroma3_cell").slideUp();
		}
		if($("#qta_aroma4_cell").css('display') != 'none' || $("#qta_aroma4_cell").css("visibility") != "hidden"){
			$("#qta_aroma4_cell").slideUp();
		}
	}else{
		if($("#qta_aroma1_pc").css('display') != 'none' || $("#qta_aroma1_pc").css("visibility") != "hidden"){
			$("#qta_aroma1_pc").slideUp();
		}
		if($("#qta_aroma2_pc").css('display') != 'none' || $("#qta_aroma2_pc").css("visibility") != "hidden"){
			$("#qta_aroma2_pc").slideUp();
		}
		if($("#qta_aroma3_pc").css('display') != 'none' || $("#qta_aroma3_pc").css("visibility") != "hidden"){
			$("#qta_aroma3_pc").slideUp();
		}
		if($("#qta_aroma4_pc").css('display') != 'none' || $("#qta_aroma4_pc").css("visibility") != "hidden"){
			$("#qta_aroma4_pc").slideUp();
		}
	}
    $('#div_ingredienti_liquido').slideToggle();    
	$('#aroma1').prop('selectedIndex',0);
	$('#aroma2').prop('selectedIndex',0);	
	$('#aroma3').prop('selectedIndex',0);
	$('#aroma4').prop('selectedIndex',0);
});

function detectmob() {
	if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i)
			 || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i)
			 || navigator.userAgent.match(/Windows Phone/i) ){
		return true;
	}else {
		return false;
	}
}