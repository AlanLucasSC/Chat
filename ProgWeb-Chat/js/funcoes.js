$(document).ready(function(){
	$('.button').click(function(){
		var text=$('#Text').val();	//Pega valor do campo Text
		console.log(text);
		$.post("php/bd.php", {text: text}, function(data){console.log(data);}, "html");
		$('#Text').val('');	//Retira o valor do campo Text
	});
}); 