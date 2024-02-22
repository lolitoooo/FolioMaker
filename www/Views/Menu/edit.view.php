<?php if (isset($form)): ?>
    <!-- Utilisez ici $form pour générer votre formulaire, par exemple : -->
    <form action="<?= $form['config']['action'] ?>" method="<?= $form['config']['method'] ?>">
        <?php foreach ($form['inputs'] as $name => $input): ?>
            <label for="<?= $name ?>"><?= ucfirst($name) ?>:</label>
            <input type="<?= $input['type'] ?>"
                   name="<?= $name ?>"
                   value="<?= $input['value'] ?>"
                   class="<?= $input['class'] ?>"
                   placeholder="<?= $input['placeholder'] ?>"
                   <?= $input['required'] ? 'required' : '' ?>>
        <?php endforeach; ?>
        <button type="submit"><?= $form['config']['submit'] ?></button>
    </form>
<?php endif; ?>
