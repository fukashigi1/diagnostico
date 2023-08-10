//Este script se encarga de cargar los campos <select> del formulario mediante AJAX y jQUERY.
$(document).ready(function() { 
    
    $.ajax({ //Llamada ajax utilizando jquery
        type: "GET",
        url: "../data/cargadores/cargador_regiones.php",
        success: function(response) {
            //console.log(response);
            var regionSelect = $("#region");
            var regiones = JSON.parse(response); //Convertir JSON a formato JavaScript.
            
            //Se itera a través de las regiones y se agregan como opciones al <select>.
            for (var i = 0; i < regiones.length; i++) {
                var option = $("<option>").attr("value", regiones[i].id).text(regiones[i].nombre);
                regionSelect.append(option);
            }
        }
    });
    
    $('#region').change(function(){ //Si el <select> region recibe una actualización.
        var nuevaRegionId = $('#region').val(); //Se obtiene la ID del elemento actual en el <select>.
        //console.log(nuevaRegionId);
        $.ajax({ //Se inicia una consula ajax para mandar la id al cargador_comunas.php donde se hará la sentencia SQL.
            type: "POST",
            url: "../data/cargadores/cargador_comunas.php",
            data: {
                nuevaRegionId: nuevaRegionId
            },
            success: function(response) { //Al cumplirse, se hará el mismo procedimiento, pero para rellenar el <select> comuna a partir de la id de region.
                //console.log(response);

                var comunaSelect = $("#comuna");
                comunaSelect.empty();
                var comunas = JSON.parse(response);

                for (var i = 0; i < comunas.length; i++) {
                    var option = $("<option>").attr("value", comunas[i].id).text(comunas[i].nombre);
                    comunaSelect.append(option);
                }
            }
        });
    });

    $('#comuna').change(function(){ //Si el <select> comuna recibe una actualización se hará el mismo procedimiento que el de comuna, pero para el <select> candidato, donde se rellenaran las opciones con los candidatos que cumplan con la ID de comuna.
        var nuevaComunaId = $('#comuna').val();
        //console.log(nuevaComunaId);
        $.ajax({
            type: "POST",
            url: "../data/cargadores/cargador_candidatos.php",
            data: {
                nuevaComunaId: nuevaComunaId
            },
            success: function(response){
                //console.log(response);
                var candidatoSelect = $("#candidato");
                candidatoSelect.empty();
                var candidatos = JSON.parse(response);

                for (var i = 0; i < candidatos.length; i++) {
                    var option = $("<option>").attr("value", candidatos[i].id).text(candidatos[i].nombre);
                    candidatoSelect.append(option);
                }
            }
        });
    });

});