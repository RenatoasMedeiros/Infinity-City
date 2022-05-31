
<?php
session_start();

//foi criada a classe utilizadores com os objetos: $username e $password
class Utilizadores
{

    public $username;
    private $password;

    function __construct($username, $password)
    {
        $this->username = $username;
        $this->setPassword($password);
    }

    //função que dá return na password
    function getPassword()
    {
        return $this->password;
    }

    function setPassword($password)
    {

        //requisito mínimo para a criação de password é ter pelo menos 4 caractéres
        if (strlen($password) >= 4) {
            $this->password = $password;
        } else {
            return "A palavra-passe deve possuir mais de 4 caractéres!";
        }
    }
}

//utilizadores e palavras-passe dos respetivos dois utilizadores
$usuario = new utilizadores("rvasco", "1234");
$administrador = new utilizadores("admin", "1234");

//verificação das credenciais
if (($usuario->username != $_POST["username"] && $usuario->getPassword() != $_POST["password"]) ||
    ($administrador->username != $_POST["username"] && $administrador->getPassword() != $_POST["password"])
) {
    //se as credenciais estiverem incorretas aparece message box
    header('Location: http://localhost/ti/index.php');
    exit;
} else {
    //se não, acessa à página principal do website
    $_SESSION["username"] = $_POST['username'];
    header('Location: http://localhost/ti/dashboard.php');
    exit;
}
?>