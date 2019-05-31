        <div>
            <?php foreach ($subs as $sub): ?>
                <?php for ($q = 0; $q < $level; $q++);
                $padding = $level * 15;
                echo '<li style="display: block; padding-left: '.$padding.'px;">
                <a href="' . ROOT_URL . 'categorias/' . $sub['slug'] . '">' . $sub['name'] . '</a>
                </li>';

                if (count($sub['subs']) > 0) {
                    $this->loadView('search_subcategory_mobile', array(
                        'subs' => $sub['subs'],
                        'level' => $level + 1,
                        'category' => $category
                    ));
                }

                ?>
            <?php endforeach; ?>
        </div>
