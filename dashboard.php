<?php
session_start();
//redirecionar em 5 segundos para index.php caso nao exista $_SESSION['username']
if (!isset($_SESSION['username'])) {
    header("refresh:5;url=index.php");
    die("Acesso restrito.");
}

//declaração das variaveis dos sensores
$valor_temperatura = file_get_contents("api/files/temperatura/valor.txt");
$nome_temperatura = file_get_contents("api/files/temperatura/nome.txt");
$hora_temperatura = file_get_contents("api/files/temperatura/hora.txt");

$valor_humidade = file_get_contents("api/files/humidade/valor.txt");
$nome_humidade = file_get_contents("api/files/humidade/nome.txt");
$hora_humidade = file_get_contents("api/files/humidade/hora.txt");

$valor_luminosidade = file_get_contents("api/files/luminosidade/valor.txt");
$nome_luminosidade = file_get_contents("api/files/luminosidade/nome.txt");
$hora_luminosidade = file_get_contents("api/files/luminosidade/hora.txt");

$valor_movimento = file_get_contents("api/files/movimento/valor.txt");
$nome_movimento = file_get_contents("api/files/movimento/nome.txt");
$hora_movimento = file_get_contents("api/files/movimento/hora.txt");

$valor_led = file_get_contents("api/files/led/valor.txt");
$nome_led = file_get_contents("api/files/led/nome.txt");
$hora_led = file_get_contents("api/files/led/hora.txt");

$valor_porta = file_get_contents("api/files/porta/valor.txt");
$nome_porta = file_get_contents("api/files/porta/nome.txt");
$hora_porta = file_get_contents("api/files/porta/hora.txt");
?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/dashboard.css">
    <meta http-equiv="refresh" content="5">
    <title>Plataforma Smart City</title>
</head>

<body>
    <?php
    //Incluir a navbar
    include_once "./navbar.html";
    ?>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <img class="float-end" src="./img/estg.png" style="width: 300px; margin-top:25px;" alt="ESTG">
                <h1 class="h1">Infinity City</h1>
                <!--Utiliza a variavel de sessao para obter o nome do utilizador-->
                <p>Bem vindo <b><?php echo ucfirst($_SESSION['username']); ?></b></p>
                <p>Tecnologias de Internet - Engenharia Informática</p>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <p>
                            <b>Luminosidade:
                                <?php echo ($valor_luminosidade); ?>
                            </b>
                        </p>
                    </div>
                    <div class="card-body">
                        <img src="./img/dia.png" alt="dia">
                    </div>
                    <div class="card-footer">
                        <p>
                            <b>Atualização: </b>
                            <?php
                            echo ($hora_luminosidade);
                            if ($_SESSION['username'] == "admin") {
                                echo ("- <a href=./historico.php?id=luminosidade&img=dia");
                                echo (">Histórico</a>");
                            }
                            ?>
                        </p>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <p><b>Temperatura:
                                <?php echo ($valor_temperatura . " ºC"); ?>
                            </b>
                        </p>
                    </div>
                    <div class="card-body">
                        <img src="./img/temperature.png" alt="temperatura">
                    </div>
                    <div class="card-footer">
                        <p>
                            <b>Atualização: </b>
                            <?php
                            echo ($hora_temperatura);
                            if ($_SESSION['username'] == "admin") {
                                echo ("- <a href=./historico.php?id=temperatura&img=temperature");
                                echo (">Histórico</a>");
                            }
                            ?>
                        </p>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <p>
                            <b>Humidade:
                                <?php echo ucfirst($valor_humidade . " %"); ?> </b>
                        </p>
                    </div>
                    <div class="card-body">
                        <img src="./img/humidade.png" alt="humidade">
                    </div>
                    <div class="card-footer">
                        <p>
                            <b>Atualização: </b>
                            <?php
                            echo ($hora_humidade);
                            if ($_SESSION['username'] == "admin") {
                                echo ("- <a href=./historico.php?id=Humidade&img=humidade");
                                echo (">Histórico</a>");
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <br>

            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <p>
                            <b>Movimento: </b>
                            <?php
                            if ($valor_movimento == 1) {
                                echo ("Movimento Detectado");
                            } else {
                                echo ("Movimento não detectado");
                            }
                            ?>
                            </b>
                        </p>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($valor_movimento == 1) {
                            echo "<img src='./img/movimentoON.png' alt='Movimento Ativo'>";
                        } else {
                            echo "<img src='./img/movimentoOFF.png' alt='Sem Movimento'>";
                        }
                        ?>
                    </div>
                    <div class="card-footer">
                        <p>
                            <b>Atualização: </b>
                            <?php
                            echo ($hora_movimento);
                            if ($_SESSION['username'] == "admin") {
                                echo ("- <a href=./historico.php?id=movimento&img=movimentoON.png");
                                echo (">Histórico</a>");
                            }
                            ?>
                        </p>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <p><b>Estado do Led:
                                <?php
                                if ($valor_led == 1) {
                                    echo ("Ligado");
                                } else {
                                    echo ("Desligado");
                                }
                                ?>
                            </b>
                        </p>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($valor_led == 1) {
                            echo "<img src='./img/led_on.png' alt='Led Ativo'>";
                        } else {
                            echo "<img src='./img/led_off.png' alt='Led Desligado'>";
                        }
                        ?>
                    </div>
                    <div class="card-footer">
                        <p>
                            <b>Atualização: </b>
                            <?php
                            echo ($hora_led);
                            if ($_SESSION['username'] == "admin") {
                                echo ("- <a href=./historico.php?id=led&img=led");
                                echo (">Histórico</a>");
                            }
                            ?>
                        </p>
                    </div>

                </div>
            </div>
            <div class="col">
                <div class="card text-center">
                    <div class="card-header">
                        <p><b>Estado da Porta:
                                <?php
                                if ($valor_porta == 1) {
                                    echo ("Aberta");
                                } else {
                                    echo ("Fechada");
                                }
                                ?>
                            </b>
                        </p>
                    </div>
                    <div class="card-body">
                        <?php
                        if ($valor_porta == 1) {
                            echo "<img src='./img/open_door.png' alt='Porta Aberta'>";
                        } else {
                            echo "<img src='./img/closed_door.png' alt='Porta Fechada'>";
                        }
                        ?>
                    </div>
                    <div class="card-footer">
                        <p>
                            <b>Atualização: </b>
                            <?php
                            echo ($hora_porta);
                            if ($_SESSION['username'] == "admin") {
                                echo ("- <a href=./historico.php?id=porta&img=door");
                                echo (">Histórico</a>");
                            }
                            ?>
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <b>Tabela de Sensores:</b>
            </div>
            <div class="card-body">
                <div class="table-responsive-md">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tipo de Dispositivo IoT</th>
                                <th scope="col">Valor</th>
                                <th scope="col">Data de Atualização</th>
                                <th scope="col">Estado Alertas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row"><?php echo $nome_luminosidade; ?></th>
                                <td><?php echo $valor_luminosidade; ?></td>
                                <td><?php echo $hora_luminosidade; ?></td>
                                <td><span class="badge rounded-pill bg-success">Ativo</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $nome_temperatura; ?></th>
                                <td><?php echo $valor_temperatura; ?>º</td>
                                <td><?php echo $hora_temperatura; ?></td>
                                <td><span class="badge rounded-pill bg-danger">Desativo</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $nome_humidade; ?></th>
                                <td><?php echo $valor_humidade; ?></td>
                                <td><?php echo $hora_humidade; ?></td>
                                <td><span class="badge rounded-pill bg-warning text-dark">Warning</span></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $nome_luminosidade; ?></th>
                                <td><?php echo $valor_luminosidade; ?></td>
                                <td><?php echo $hora_luminosidade; ?></td>
                                <td><span class="badge rounded-pill bg-danger">Muito Forte</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>