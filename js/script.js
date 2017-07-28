var permite=0;
var permite2=0;
$( document ).ready(function() {
    
$("#guardar").click(function(){
    GuardarDatos();
});

$("#correo").blur(function(){
    verifica(document.getElementById('correo'));
});

$("#correo").keyup(function(){
    verifica(document.getElementById('correo'));
});
$('.slider').slider({
  indicators: false
})
$('.slider').css('height', '100%')
$('.slides').css('height', '100%')
$('#Estudiante').material_select();
$('#playera').material_select();
$(".dropdown-button").dropdown();

llenaInscritos();

  function GuardarDatos(){
    var nombre=$("#nombre").val();
    var apellido=$("#apellido").val();
 /*   var telefono=$("#telefono").val();
    var correo=$("#correo").val();
    var carrera=$("#carrera").val();
    var colegio=$("#colegio").val();*/
    var face=$("#codigoRR").val();
    var talla=$("#playera").val();
    var Estudiante=$('#Estudiante').val();
    verificaClave(face);
    //verifica(document.getElementById('correo'));
    permite = 1
    setTimeout(function(){
    if(nombre!="" && apellido!="" && talla!="" && Estudiante!="" && face!=""){
        if(permite){
            if(permite2){
                $.ajax
                    ({
                        async:false,    
					    cache:false,  
                        type:"POST",
                        dataType: 'json',
                        data:' nombre=' +  nombre + '&face=' + face + '&Estudiante=' + Estudiante + '&talla=' + talla + '&apellido=' + apellido + '&tipo=2', // + '&telefono=' + telefono + '&correo=' + correo + '&carrera=' + carrera + '&colegio=' + colegio
                        url:"php/ingresoDatos.php",
                        success: function(resp)
                        {
                            //alert(resp['estatus']);
                            if(resp['estatus']=='1'){
                                notif({
                                        type: "success",
                                        msg: "Datos Guardados",
                                        position: "center",
                                        fade: false,
                                        autohide: false
                                    });
                                    limpiar();
                                    setTimeout(function(){location.href="https://www.facebook.com/UMGINGREU/";},500);
                            }else{
                                notif({
                                        type: "error",
                                        msg: "Algo malo Sucedio",
                                        position: "center",
                                        fade: false,
                                        autohide: false
                                    });
                                    
                            }
                        }    
                    });
            }else{
                notif({
                        type: "error",
                        msg: "El codigo no esta Disponible",
                        position: "center",
                        fade: false,
                        autohide: false
                    });
                    $('#correo').focus();
            }
        }else{
            notif({
                    type: "error",
                    msg: "Parece que el Email ya esta Registrado",
                    position: "center",
                    fade: false,
                    autohide: false
                });
                $('#correo').focus();
        }
    }else{
            notif({
                    type: "error",
                    msg: "Debe completar todos los Campos",
                    position: "center",
                    fade: false,
                    autohide: false
                });
                
        }
    },300);
}

function verifica(email){
    emai=email.value;
    $.ajax
        ({
            async:false,    
            cache:false,  
            type:"POST",
            data:' emai=' +  emai + '&tipo=1',
            dataType: 'json',
            url:"php/ingresoDatos.php",
            success: function(resp)
            {
				if(resp['estatus']=='1'){
                    email.style.border='green';
                    permite=1;
                }else{
                    email.style.border='red';
                    permite=0;
                }
                
            } 
        });
}

function verificaClave(clave){
    var respuesta='';
    $.ajax
        ({
            async:false,    
            cache:false,  
            type:"POST",
            data:' clave=' +  clave + '&tipo=3',
            dataType: 'json',
            url:"php/ingresoDatos.php",
            success: function(resp)
            {
			    if(resp['estatus']=='1'){
                    permite2=1;
                }
            } 
        });
        
}

function llenaInscritos(){
    $.ajax
        ({
            async:false,    
            cache:false,  
            type:"POST",
            data:'tipo=4',
            url:"php/ingresoDatos.php",
            success: function(resp)
            {
                document.getElementById('Inscritos').innerHTML = resp;                
            } 
        });
}

function limpiar(){
    $("#nombre").val('');
    $("#apellido").val('');
    $("#codigoRR").val('');
    /*$("#telefono").val('');
    $("#correo").val('');
    $("#carrera").val('');
    $("#colegio").val('');
*/
     $("#nombre").prop('disabled',true);
     $("#codigoRR").prop('disabled',true);
    $("#apellido").prop('disabled',true);
  /*  $("#telefono").prop('disabled',true);
    $("#correo").prop('disabled',true);
    $("#carrera").prop('disabled',true);
    $("#colegio").prop('disabled',true);*/
}


});