<!DOCTYPE html>
<html lang="fr">
    <head>
    <meta charset="UTF-8">
        <link rel="stylesheet" href="../../dist/css/style.css">
        <link rel="icon" type="image/svg" href="../../src/assets/logo/LogoFolioMaker.svg" />
        <script src="https://kit.fontawesome.com/18a6431c94.js" crossorigin="anonymous"></script>
        <!-- CSS de DataTables -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

        <!-- JS de jQuery et DataTables -->
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
        <title>Front Template</title>
    </head>
    <body>
        <div class="dashboard">
        <?php if (isset($showSidebar) && $showSidebar): ?>
            <?php include 'Views/Components/sidebar.view.php'; ?>
        <?php endif; ?>

        <!-- <div class="main-content"> -->
        <?php include $this->view;?>
        <!-- </div> -->
    </div>
    </body>
</html>