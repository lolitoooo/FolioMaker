<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageData->getTitle(); ?></title>
    <style>
        <?php echo $pageData->getCss(); ?>
    </style>
</head>
<body>
    <?php echo $pageData->getHtml(); ?>
    <script>
        <?php echo $pageData->getJs(); ?>
    </script>
</body>
</html>
