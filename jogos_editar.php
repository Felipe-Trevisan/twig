<?php
require('carregar_pdo.php');
require('carregar_twig.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $id = (int) $_POST['id'] ?? false;
    $nome = $_POST['nome'] ?? false;
    $estilo = $_POST['estilo'] ?? false;
    $lancamento = $_POST['lancamento'] ?? false;

    if(!$_FILES['capa']['error']){
        $dados = $pdo->prepare('select capa from jogos where id = :id');
        $dados->execute([':id' => $id]);
        $capa_velha = $dados->fetch(PDO::FETCH_ASSOC)['capa'];
        
        $capa_velha = __DIR__ . '/img/' . $capa_velha;
        if($capa_velha && file_exists($capa_velha)){
            unlink($capa_velha);
        }

        $ext = pathinfo($_FILES['capa']['name'], PATHINFO_EXTENSION);
        $capa = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['capa']['tmp_name'], "img/{$capa}");

    };

    $sql = 'update jogos set nome = :nome, estilo = :estilo, lancamento = :lancamento' . (isset($capa) ?', capa = :capa' : '') . ' where id = :id';
    $dados = $pdo->prepare($sql);

    $params = [
        ':id' => $id,
        ':nome'=> $nome,
        ':estilo' => $estilo,
        ':lancamento'=> $lancamento
    ];
    if(isset($capa)){
        $params[':capa'] = $capa;
    }
    $dados->execute($params);

   header('location: jogos.php');
    die;    

}
$id = (int) $_GET['id'] ?? false;
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