<?php
    session_start();

    //Erreurs
    require('master/modules/errors.php');
    $GLOBALS['class_errors'] = new errors();

    //Security log
    require('master/modules/log/security.php');
    $GLOBALS['class_security_logs'] = new security_log();

    
    //Configuration (Titre du site, db...)
    $config = parse_ini_file('config.ini');
    
    $host = $config['host_database'];
    $dbname = $config['database'];
    $user = $config['user_database'];
    $pass = $config['password_database'];

    //Connexion à la base de données
    require('master/modules/database/connect.php');

    
    $GLOBALS['title_site'] = $config['title_site'];
    $GLOBALS['name_template'] = 'template-1';

    $body_background_color = $config['body_background_color'];
    
    
    //Traitement de l'URI pour connaitre la page demandé
    $url = $_SERVER['REQUEST_URI'];
    
    
    $position_get = strripos($url, '?');
    
    if(!empty($position_get)) {
        $url = substr($url, 0, $position_get);
    }
    
    //On verifie si il y a .php, sinon on rajoute index.php
    if (!preg_match('/.php/', $url)) {
        $url = $url . '/index.php';
    }

    $GLOBALS['url'] = $url;
    
    //Chemin
    require('master/path.php');
