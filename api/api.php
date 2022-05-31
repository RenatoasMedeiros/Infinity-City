<?php
header('Content-Type: text/html; charset=utf-8');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    print_r($_POST);
    echo "\n";
    echo isset($_POST);
    echo "\n";
    file_put_contents("files/" . $_POST['nome'] . "/hora.txt", $_POST['hora']);
    file_put_contents("files/" . $_POST['nome'] . "/valor.txt", $_POST['valor']);
    file_put_contents("files/" . $_POST['nome'] . "/log.txt", $_POST['hora'] . ";" . $_POST['valor'] . PHP_EOL, FILE_APPEND);
    echo "\n";
    echo ("recebi um POST");
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET["nome"])) {
        if (($_GET['nome'] = "temperatura") || ($_GET['nome'] = "luminosidade") || ($_GET['nome'] = "humidade") || $_GET['nome'] = "movimento") {
            echo file_get_contents("files/" . $_GET['nome'] . "/valor.txt");
        } else {
            http_response_code(400);
            echo "Erro: Sensor inválido";
        }
    } else {
        echo "\n";
        http_response_code(400);
        echo ("Erro: Faltam parametros no GET");
    }
} else {
    echo "\n";
    http_response_code(403);
    echo ("Erro: Método não permitido");
}