<?php

require('carregar_twig.php');

$nome = "Você";
$disciplinas = [
    'PW',
    'BD',
    'IW',
    'DS',
];

echo $twig->render('teste_twig.html', [
    'nome'=> $nome,
    'legal' => true,
    'disciplinas' => $disciplinas,
]);