<?php
session_start();
//Verifica se o utilizador é Administrador
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header("refresh:5;url=index.php");
    die("Acesso restrito.");
}


//vai buscar os dados ao ficheiro atravez do parametro
$dados = file_get_contents("api/files/" . $_GET["id"] . "/log.txt");

//formatação da string obtida na leitura (Substitui ";" por " ", e cria um array ($linhas) que guarda em cada elemento uma linha da log)
$dados = str_replace(";", " ", $dados);
$linhas = explode("\n", $dados);

//guarda o valor do parametro GET["img"];
$img = $_GET["img"];

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Mostra atravez do parametro da URL o nome do Sensor-->
    <title>Histórico - <?php echo ucfirst($_GET["id"]) ?></title>
    <meta http-equiv="refresh" content="5">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>
    <?php
    //Inclusão da navbar
    include_once "./navbar.html";
    ?>
    <div class="container">
        <div class="card" style="margin-top: 20px;">
            <div class="card-body">
                <img class="float-start" src="<?php echo "./img/" . $_GET["img"] . ".png" ?>" style="margin-right: 20px;" alt="Sensor">
                <!--Mostra atravez do parametro da URL o nome do Sensor-->
                <h1 style="margin-top: 40px;">Histórico - Sensor de <?php echo ucfirst($_GET["id"]) ?></h1>
            </div>
        </div>
    </div>
    <br>
    <div class="container lg-10 md-8 sm-6">
        <div class="card">
            <table class="table">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"><b>Data de registo</b></th>
                        <th scope="col"><b>Valor</b></th>
                    </tr>
                </thead>
                <tbody class="table-light">
                    <?php
                    //For decrescente para que os ultimos valores sejam vistos primeiro
                    for ($i = count($linhas) - 1; $i >= 0; $i--) { // count -1 visto que o indice começa em 0, e a funcção count em 1, logo é necessario equiparar as 2 variaveis
                        echo "<tr> <td>" . substr($linhas[$i], 0, 20) . "</td>";
                        echo "<td>" . substr($linhas[$i], 20) . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>