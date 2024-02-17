<?php if(!empty($errors)):?>
<div style="background-color: red;">
    <?php echo implode("<br>", $errors); ?>
</div>
<?php endif; ?>

<form
    action="<?= $config["config"]["action"] ?? "" ?>"
    method="<?= $config["config"]["method"] ?? "POST" ?>"
    id="<?= $config["config"]["id"] ?? "" ?>"
    class="<?= $config["config"]["class"] ?? "" ?>"
>
    <?php 
    $hasIndividualSubmitButtons = false; // Ajout d'un indicateur pour les boutons individuels

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
                $hasIndividualSubmitButtons = true; // Si un champ a un bouton individuel, on note cette condition
            ?>
                <!-- Bouton de soumission spécifique pour ce champ -->
                <button type="submit" name="action" value="update<?= ucfirst($name) ?>"><?= $input["submitLabel"] ?></button>
            <?php endif; ?>
        </div><br>
    <?php endforeach; 

    // Afficher le bouton de soumission général seulement s'il n'y a pas de boutons de soumission individuels
    if (!$hasIndividualSubmitButtons): ?>
        <input type="submit" value="<?= $config["config"]["submit"] ?? "Envoyer" ?>">
    <?php endif; ?>
</form>