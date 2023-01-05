<?php
    require_once '../classes/string-tokenizer.php';
    require_once '../classes/analizador-lexico.php';
    $lexico = new Lexico($_POST['sentencias']);
?>