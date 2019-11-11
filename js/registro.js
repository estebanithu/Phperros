$(document).ready(function(){
	$("#formRegistro").on("submit", validarFormRegistro);
});


function validarFormRegistro(){
	event.preventDefault();
	let pass = $("#password").val();
	let error = false;
	if(pass.length >= 8){
		let re = /\S*(\S*([a-zA-Z]\S*[0-9])|([0-9]\S*[a-zA-Z]))\S*/g;
		let tieneLetraYNumero = re.test(pass);
		if(!tieneLetraYNumero){
			error = true;	
		}
	}else{
		error = true;
	}
	if(error){
		$("#error-password").css("display","block");
	}else{
		$("#error-password").css("display","none");
		$("#formRegistro").off();
		$("#formRegistro").submit();
	}	
}