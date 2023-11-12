<?php 
require_once __DIR__ . '/../../functions/database/connect.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../../dist/main.css">
        <link rel="icon" type="image/svg" href="../../src/assets/logo/LogoFolioMaker.svg" />
        <title>Back</title>
    </head>
    <body>
        <img src="../../src/assets/logo/LogoAllFolioMaker.svg" alt="Logo" width="300px">
        <h1>Template du back</h1>
        <?php include $this->view;?>
    </body>
</html>
