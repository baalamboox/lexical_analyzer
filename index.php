<!DOCTYPE html>
<html lang="es-MX">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analizador Léxico</title>
    <link rel="stylesheet" href="lib/bootstrap-4.6.0-dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('img/background.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        #jumbotron_personalizado {
            background-color: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(5px);
            border-top-left-radius: 0px;
            border-top-right-radius: 0px;
            border-bottom-left-radius: 10px;
            border-bottom-right-radius: 10px;
            color: white;
        }
        th, td {
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="jumbotron shadow" id="jumbotron_personalizado">
                    <div>
                       <h1 class="display-4">Analizador Léxico</h1>
                        <p class="lead">Este es un simple analizador léxico, programado en PHP.</p> 
                    </div>
                    <hr class="my-4 border-white">
                    <div class="mb-5" id="analizador_lexico">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-sm-4">
                                    <div class="text-center">
                                        <span class="btn btn-light btn-block btn-sm rounded-pill" id="boton_reglas">Reglas</span>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <span class="btn btn-light btn-block btn-sm rounded-pill" id="boton_caracteristicas">Características</span>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <span class="btn btn-light btn-block btn-sm rounded-pill" id="boton_simbolos">Símbolos</span>
                                    </div>
                                    <hr>
                                    <div class="text-center">
                                        <span class="btn btn-light btn-block btn-sm rounded-pill" id="boton_palabras_reservadas">Palabras reservadas</span>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <form>
                                        <div class="form-group">
                                            <label for="sentencias">Escribir sentencias:</label>
                                            <textarea name="sentencias" id="sentencias" cols="30" rows="10" class="form-control" placeholder="Ingresar sentencias de acuerdo al lenguaje LX"></textarea>
                                        </div>
                                        <div class="btn-group btn-block">
                                            <span class="btn btn-dark btn-sm" id="boton_limpiar">Limpiar</span>
                                            <span class="btn btn-light btn-sm" id="boton_analizar">Analizar</span>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tabla_resultados">
                        <table class="table table-responsive-sm table-striped table-borderless">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Lexema</th>
                                    <th>Tipo</th>
                                    <th>Línea</th>
                                </tr>
                            </thead>
                            <tbody id="mostrar_datos"></tbody>
                        </table>
                    </div>
                    <hr class="my-4 border-white">
                    <div class="text-center">
                        <span class="btn btn-light btn-sm w-25" id="boton_mostrar_ocultar">Mostrar analizador</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="lib/jquery-3.6.0/jquery-3.6.0.min.js"></script>
    <script src="lib/bootstrap-4.6.0-dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/main.js"></script>
</body>
</html>