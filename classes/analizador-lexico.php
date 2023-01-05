<?php
    class Lexico {
        protected $_lineas;
        protected $_numero;
        protected $_token;
        protected $_tokens = array();
        protected $_afd = array(
            0 => array(3, false, 1, false),
            1 => array(3, 3, 2, false),
            2 => array(3, false, false, false),
            3 => array(3, 3, false, true)
        );
        protected $_tokenList = array(
            // Símbolos.
            " " => "ESPACIO",
            '"' => "COMILLA DOBLE",
            "*" => "MULTIPLICACION",
            "+" => "SUMA",
            "-" => "RESTA",
            "/" => "DIVISION",
            "=" => "IGUAL",
            ">" => "MAYOR QUE",
            "<" => "MENOR QUE",
            // Palabras reservadas.
            "entero"  => "TIPO DATO ENTERO",
            "cadena"  => "TIPO DATO CADENA",
            "si"      => "ESTRUCTURA CONDICIONAL IF",
            "entonces" => "THEN",
            "escribir" => "ESCRITURA",
            "fin"     => "FIN ESTRUCTURA CONTROL"
        );
        protected $_delimitadores = ' "'; // Los delimitadores son ESPACIO y COMILLA DOBLE.
        function __construct($txt) {
            $this->_lineas   = preg_split("/(\r\n|\n|\r)/", trim($txt));
            foreach($this->_lineas as $numero => $linea) {
                $this->_numero = $numero;
                $this->lexico($linea);
            }
            $this->printTokens();
        }
        function lexico($linea) {
            $tokens_line = new StringTokenizer($linea, $this->_delimitadores);
            foreach($tokens_line as $pos => $tok) {
                $this->_token = $tok;
                $busqueda = $this->buscarExpresion();
                if($busqueda === false) {
                    if($this->esNumerico()) {
                        $this->_tokens[] =  $this->returnTokenItem("ENTERO");
                    } else if($this->esIdentificador()) {
                        $this->_tokens[] = $this->returnTokenItem("IDENTIFICADOR");
                    } else {
                        $this->_tokens[] = $this->returnTokenItem("ERROR");
                    }
                } else {
                    $this->_tokens[] =  $this->returnTokenItem();
                }
            }
        }
        function buscarExpresion($c = null) {
            if($c == null) {
                $c = $this->_token;
            }
            foreach($this->_tokenList as $exp => $name) {
                if($exp == $c) {
                    return $name;
                }
            }
            return false;
        }
        function returnTokenItem($v = false) {
            if($v == false) {
                $v = $this->_tokenList;
            } else {
                $token =  $v;
            }
            if(is_array($v)) {
                $token = $this->buscarExpresion();
            }
            return array(
                'lexema' => $this->_token,
                'token' => $token,
                'linea' => $this->_numero+1
            ); 
        }
        function esLetra($c = null) {
            if($c == null) {
                $c = $this->_token;
            }
            $c = ord(strtolower($c));
            if($c >= 97 && $c <= 122) {
                return true;
            }
            return false;
        }
        function esNumerico($c = null) {
            if($c == null) {
                $c = $this->_token;
            }
            if(is_numeric($c)) {
                $c = ord(strtolower((int)$c));
                if($c >= 48 && $c <= 57) {
                    return true;
                }
            }
            return false;
        }
        function esGuionBajo($c = null) {
            if($c == null) {
                $c = $this->_token;
            }
            return ($c == "_");
        }
        function esIdentificador($c = null) {
            if($c == null) {
                $c = $this->_token;
            }
            $transiciones = strlen($c);
            $i = 0;
            $estado = 0;
            while($i <= $transiciones) {
                if($i == $transiciones) {
                    $entrada = 3; // COLUMNA DE ACEPTACIÓN.
                } else {
                    $entrada = $c[$i];
                    if($this->esLetra($entrada)) {
                        $entrada = 0; // Letra
                    } else if($this->esNumerico($entrada)) {
                        $entrada = 1; // Digito
                    } else if($this->esGuionBajo($entrada)) {
                        $entrada = 2; // GuionBajo
                    } else {
                        return false;
                    }
                }
                $estado = $this->_afd[$estado][$entrada];
                if($estado === false || $estado === true) {
                    return $estado;
                }
                $i++;
            }
        }
        function printTokens(){
            foreach ($this->_tokens as $num => $item) {
                echo "<tr><td>" . ($num + 1) . "</td>";
                foreach($item as $valor) {
                    if($valor == "ERROR") {
                        $valor = "<b>" . $valor . "</b>";
                    }
                    echo "<td>" . $valor . "</td>";
                }
                echo "</tr>";
            }
        }
    }
?>