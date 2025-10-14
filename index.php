<?php
use Models\Nacionalidade;
require 'models/nacionalidade.php';



$nacionalidade = new Nacionalidade(null, null);
$nacionalidades = json_encode($nacionalidade->listar());
echo $nacionalidades;
