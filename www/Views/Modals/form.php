<?php if(!empty($errors)):?>
<div style="background-color: red;">
    <?php echo implode("<br>", $errors); ?>
</div>
<?php endif; ?>

<div class="form_container">
<h3><?= $title; ?></h3>

<form
    action="<?= $config["config"]["action"] ?? "" ?>"
    method="<?= $config["config"]["method"] ?? "POST" ?>"
    id="<?= $config["config"]["id"] ?? "" ?>"
    class="<?= $config["config"]["class"] ?? "" ?>"
>
    <?php 
    $hasIndividualSubmitButtons = false; 

    foreach ($config["inputs"] as $name => $input): ?>
        <div>
            <input
                name="<?= $name ?>"
                type="<?= $input["type"] ?? "text" ?>"
                class="<?= $input["class"] ?? "" ?>"
                id="<?= $input["id"] ?? "" ?>"
                placeholder="<?= $input["placeholder"] ?? "" ?>"
                value="<?= htmlspecialchars($input["value"] ?? '') ?>"
                <?= $input["required"] ? "required" : "" ?>
            >

            <?php if(isset($input["submitLabel"])): 
                $hasIndividualSubmitButtons = true; 
            ?>
                <!-- Bouton de soumission spécifique pour ce champ -->
                <button class="button" type="submit" name="action" value="update<?= ucfirst($name) ?>"><?= $input["submitLabel"] ?></button>
            <?php endif; ?>
        </div><br>
    <?php endforeach; 

    if (!$hasIndividualSubmitButtons): ?>
        <input class="button" type="submit" value="<?= $config["config"]["submit"] ?? "Envoyer" ?>">
    <?php endif; ?>
</form>
</div>