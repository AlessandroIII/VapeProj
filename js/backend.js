// function changeStatus(id, op){
// 	if(op == 'd'){
// 		$('#idutd').val(id);
// 		exit();
// 		$('#id_delete').submit();

// 	}else if(op == 'a'){
// 		$('#idutr').val(id);
// 		$('#id_reactive').submit();
// 	}
// }

function redirect_to(link, dest){
	if(dest=='n')window.open(link);
	if(dest=='s')window.location.href=link;
}

