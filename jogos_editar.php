<?php
require('carregar_pdo.php');
require('carregar_twig.php');

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = (int) $_GET['id'] ?? false;
}

if(!$id){
    header('location:jogos.php');
    die;
}else{

$dados = $pdo->prepare('Select * from jogos where id = :id');
$dados->execute(['id'=> $id]);
$jogo = $dados->fetch(PDO::FETCH_ASSOC);
}

echo $twig->render('jogos_editar.html', [
    'jogo' => $jogo,
]);