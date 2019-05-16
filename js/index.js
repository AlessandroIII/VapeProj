function redirect_to(link, dest){
	if(dest=='n')window.open(link);
	if(dest=='s')window.location.href=link;
}

function modifyAdmin(id, page){
	window.location.href="modifica_"+page+".php?id="+id;
}

$(window).unload(function(){
alert("Goodbye!");
});

$('#tableAromi').DataTable({
    "lengthMenu": [[5, 15, 30, -1], [5, 15, 30, "All"]],
});
$('#tableAromi_info').css('color', 'white');
$('#tableAromi_filter').addClass("col-sm-6 col-lg-1 col-md-6 col-xs-5");
$('#tableAromi_length').addClass("col-sm-6 col-lg-1 col-md-6 col-xs-5");

$('#tableLiquidi').DataTable({
     "lengthMenu": [[5, 15, 30, -1], [5, 15, 30, "All"]],
});
$('#tableLiquidi_info').css('color', 'white');
$('#tableLiquidi_filter').addClass("col-sm-6 col-lg-1 col-md-6 col-xs-5");
$('#tableLiquidi_length').addClass("col-sm-6 col-lg-1 col-md-6 col-xs-5");

// JS RANGE SLIDER
// var $rangeslider = $('#prezzo');
// var minBoxValue = $('#min_value_jSlider');
// var maxBoxValue = $('#max_value_jSlider');

// // SETTINGS
// $rangeslider.ionRangeSlider({
//         type: "double",
//         min: 2,
//         max: 50,
//         from: 2,
//         to: 50,
//         grid: true,
//         step: 1,
//         drag_interval: true,
//         hide_min_max: true
//     });

// $rangeslider.on("change", function(){
//     var $inp = $(this);
//     var v = $inp.prop("value");
//     var min = $inp.data("from");
//     var max = $inp.data("to");
//     minBoxValue.val(min);
//     maxBoxValue.val(max);
// });