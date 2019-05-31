        <div class="container">
        <?php foreach ($subs as $sub): ?>
            <?php for ($q = 0; $q < $level; $q++);
            echo '<li class="nav-item" style="display: block;">
                    <a style="color: #FFFFFF;" href="' . ROOT_URL . 'categorias/' . $sub['slug'] . '">' . $sub['name'] . '</a>
                  </li>';

            if (count($sub['subs']) > 0) {
                $this->loadView('search_subcategory', array(
                    'subs' => $sub['subs'],
                    'level' => $level + 1,
                    'category' => $category
                ));
            }

            ?>
        <?php endforeach; ?>
        </div>
