//Este script se encarga de actuar como conexión entre el documento HTML y el archivo PHP mandar_voto.
$(document).ready(function() {
    var region = 0;
    var comuna = 0;
    //Si se registra un cambio en los <select>. Se tomará la variable actualizada.
    $('#region').change(function(){
        region = $("#region").val(); 
    });
    $('#comuna').change(function(){
        comuna = $("#comuna").val();
    });
    $("#formularioVotacion").submit(function(event) { //Al presionar el botón "Votar".
        event.preventDefault(); //Se detiene el comportamiento por defecto (recargar página).

        //Almacenar a variables correspondientes.
        var nombreApellido = $("#nombreApellido").val();
        var alias = $("#alias").val();
        var rut = $("#rut").val();
        var email = $("#email").val();
        var candidato = $("#candidato option:selected").text();
        var web = $("#web").prop("checked");
        var tv = $("#tv").prop("checked");
        var redesSociales = $("#redesSociales").prop("checked");
        var amigo = $("#amigo").prop("checked");
        
        //Se transforman los ComboBox de booleanos a números binarios (Tinyint) para base de datos MySQL.
        if (web == true){web = 1;}else{web = 0;}
        if (tv == true){tv = 1;}else{tv = 0;}
        if (redesSociales == true){redesSociales = 1;}else{redesSociales = 0;}     
        if (amigo == true){amigo = 1;}else{amigo = 0;}

        $.ajax({ //Llamada ajax utilizando jquery.
            type: "POST",
            url: "mandar_voto.php",
            data: {
                nombreApellido: nombreApellido,
                alias: alias,
                rut: rut,
                email: email,
                region: region,
                comuna: comuna,
                candidato: candidato,
                web: web,
                tv: tv,
                redesSociales: redesSociales,
                amigo: amigo
            },
            success: function(response) { //Esta funcion se ejecuta en el div id resultado si se completó con éxito.
                $("#resultado").html(response);
            }
        });
    });
});