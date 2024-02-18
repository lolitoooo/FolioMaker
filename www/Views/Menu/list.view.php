<?php if (!empty($menus)): ?>
    <ul>
        <?php foreach ($menus as $menu): ?>
            <li>
                <?php
                if (!empty($menu['content'])) {
                    $structure = json_decode($menu['content'], true);
                    foreach ($structure as $item) {
                        echo htmlspecialchars($item['name']) . ' | ';
                    }
                }
                ?>
                - <a href="/menu/edit/<?= $menu['id'] ?>">Éditer</a>
                - <form action="/menu/delete" method="post">
                    <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>">
                    <button type="submit">Supprimer</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun menu trouvé.</p>
<?php endif; ?>
