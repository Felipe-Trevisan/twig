<?php

require('carregar_twig.php');

$nome = "Você";
$disciplinas = [
    'PW',
    'BD',
    'IW',
    'DS',
];

$poema = '
No alto daquele cume,
Plantei uma roseira.
O vento no cume bate,
A rosa no cume cheira.
 
Quando cai a chuva fina,
Salpicos no cume caem.
Formigas no cume entram,
Abelhas do cume saem.

Quando cai a chuva grossa,
A água no cume desce.
O barro no cume escorre,
O mato no cume cresce.

Então quando cessa a chuva,
No cume volta a alegria.
Pois torna a brilhar de novo
O sol que no cume ardia.';

echo $twig->render('teste_twig.html', [
    'nome'=> $nome,
    'legal' => true,
    'disciplinas' => $disciplinas,
    'poema'=> $poema,
]);