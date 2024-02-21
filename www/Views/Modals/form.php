<body class="form-page">
    <div class="background">

    </div>
    <div class="form-wrapper">
        <div class="form_container">
            <h3><?php echo $title; ?></h3>
            <?php if (!empty($errors)) : ?>
                <div class="error-message">
                    <?php echo implode("<br>", $errors); ?>
                </div>
            <?php endif; ?>

            <form action="<?= $config["config"]["action"] ?? "" ?>" method="<?= $config["config"]["method"] ?? "POST" ?>" id="<?= $config["config"]["id"] ?? "" ?>" class="<?= $config["config"]["class"] ?? "" ?>">

                <?php foreach ($config["inputs"] as $name => $input) : ?>
                    <div class="input-container"> <!-- Ajout du conteneur pour chaque input -->
                        <label for="<?= $input["id"] ?? "" ?>"><?= $input["placeholder"] ?? "" ?></label>
                        <input name="<?= $name ?>" type="<?= $input["type"] ?? "text" ?>" class="form-input <?= $input["class"] ?? "" ?>" id="<?= $input["id"] ?? "" ?>" placeholder="<?= $input["placeholder"] ?? "" ?>" value="<?= htmlspecialchars($input["value"] ?? '') ?>" <?= $input["required"] ? "required" : "" ?>>
                    </div>
                <?php endforeach; ?>
                <button type="submit" class="form-input"><?= $config["config"]["submit"] ?? "Submit" ?></button>


            </form>
        </div>
    </div>
</body>