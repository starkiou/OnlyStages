<?php
session_start();

// On recupere l'url
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
$url = explode('/', $url);

if(!isset($_SESSION['typecompte'])){
    $_SESSION['typecompte']=0;
}

define('ROOT_DIR', __DIR__ . DIRECTORY_SEPARATOR);

require __DIR__ . '/app/core/config.php';

switch (true) {
    //---------------PAGES PRINCIPALES--------------------//

    case ($url == ''):
        require ROOT_DIR . 'app/views/home/home.php';
        exit;
    case ($url[0] === 'home'):
        require ROOT_DIR . 'app/views/home/home.php';
        exit;
    case ($url[0] === 'companies'):
        require ROOT_DIR . 'app/views/home/companies.php';
        exit;
    case ($url[0] === 'stages'):
        require ROOT_DIR . 'app/views/home/stages.php';
        exit;
    case ($url[0] === 'login'):
        require ROOT_DIR . 'app/views/user/login.php';
        exit;
    case ($url[0] === 'signup'):
        require ROOT_DIR . 'app/views/user/signup.php';
        exit;
    case (($url[0] === 'import') && ($_SESSION['typecompte']===3)):
        require ROOT_DIR . 'app/views/home/importation.php';
        exit;

    //---------------CONNEXION ET CORE PHP--------------------//

    case ($url[0] === 'config'):
        require ROOT_DIR . 'app/core/config.php';
        exit;
    case ($url[0] === 'confirmLogin'):
        require ROOT_DIR . 'app/core/confirmLogin.php';
        exit;
    case ($url[0] === 'logoff'):
        require ROOT_DIR . 'app/core/logoff.php';
        exit;
    case ($url[0] === 'register'):
        require ROOT_DIR . 'app/core/register.php';
        exit;

    // Les imports modifient la base : réservés aux administrateurs
    case (in_array($url[0], ['importationBDD', 'insertion'], true) && (int)$_SESSION['typecompte'] !== 3):
        http_response_code(403);
        echo json_encode(['error' => 'Accès non autorisé']);
        exit;

    case ($url[0] === 'importationBDD'):
        require_once ROOT_DIR . 'app/core/importationBDD.php';
        exit;
    case ($url[0] === 'insertion'):
        require_once ROOT_DIR . 'app/core/insertion.php';
        exit;
    case ($url[0] === 'stageController'):
        require_once ROOT_DIR . 'app/core/stageController.php';
        exit;
    

    //---------------ERREURS ET EXCEPTIONS--------------------//

    default:
        http_response_code(404);
        require ROOT_DIR . 'app/views/home/404.php';
        exit;
}
