$(document).ready(() => {
    function validar_textarea_vacia() {
        if($('#sentencias').val() == '') {
            Swal.fire('¡Upps¡', 'Debe de existir al menos una sentencia.', 'warning');
        } else {
            $.ajax({
                type: 'POST',
                url: 'control/tabla-datos.php',
                data: {
                    'sentencias': $('#sentencias').val()
                },
                success: resultado => {
                    $('#tabla_resultados').show();
                    $('#mostrar_datos').html(resultado);
                }
            });
        }
    }
    let contador = 0;
    $('#analizador_lexico').hide();
    $('#tabla_resultados').hide();
    $('#boton_mostrar_ocultar').click(() => {
        $('#analizador_lexico').toggle(resultado => {
            if(resultado == undefined) {
                if((contador % 2) == 1) {
                    $('#boton_mostrar_ocultar').text('Mostrar analizador');
                } else {
                    $('#boton_mostrar_ocultar').text('Ocultar analizador');
                }
                contador++;
            }
        });
    });
    $('#boton_analizar').click(() => {
        validar_textarea_vacia();
    });
    $('#boton_limpiar').click(() => {
        $('#sentencias').val('');
    });
    $('#boton_reglas').click(() => {
        Swal.fire({
            html: '<p style="text-align: justify;"><b>El AFD plantea que los identificadores:</b><br>1.- NO pueden comenzar por DIGITO.<br>2.- Pueden empezar por 1 ó 2 GUIÓN BAJO.<br>3.- No puede comenzar por 3 o más.<br>4.- NO permite GUIÓN BAJO en otra parte distinta al inicio.<br>5.- Puede contener DIGITO solo si antes ya tiene o LETRA o GUIÓN BAJO.',
            icon: 'info'
        });
    });
    $('#boton_caracteristicas').click(() => {
        Swal.fire({
            html: '<p style="text-align: justify;"><b>Características:</b><br>1.- No utiliza PUNTO Y COMA (;) para indicar el fin de una línea.<br>2.- Las palabras reservadas y los símbolos están en una lista, la cual permite la facilidad de poder añadir elementos en un futuro.<br>3.- Los identificadores se validan en un AFD.',
            icon: 'info'
        });
    });
    $('#boton_simbolos').click(() => {
        Swal.fire({
            html: '<p style="text-align: justify;"><b>Solo acepta los siguientes símbolos:</b><br>1.- COMILLA DOBLE (")<br>2.- DIVISIÓN (/)<br>3.- MULTIPLICACIÓN (*)<br>4.- RESTA (-)<br>5.- SUMA (+)<br>6.- IGUAL (=)<br>7.- MENOR QUE (<)<br>8.- MAYOR QUE (>)</p>',
            icon: 'info'
        });
    });
    $('#boton_palabras_reservadas').click(() => {
        Swal.fire({
            html: '<p style="text-align: justify;"><b>Solo acepta las siguientes palabras reservadas:</b><br>1.- TIPO DE DATO ENTERO (entero)<br>2.- TIPO DE DATO CADENA (cadena)<br>3.- ESTRUCTURA CONDICIONAL IF (si)<br>4.- THEN (entonces)<br>5.- ESCRITURA (escribir)<br>5.- FIN DE ESTRUCTURA DE CONTROL (fin)</p>',
            icon: 'info'
        });
    });
});