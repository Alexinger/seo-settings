<!-- Table all product -->
<?php

    global $post;

    $args = array('post_type' => array('product', 'attachment'), 'numberposts' => -1, 'nopaging' => true, 'post_mine_type' => 'image', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'title');
    $myposts = get_posts($args);

    ?>

<div class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Все товары сайта (publish)</h2>
        <div class="btn rgba-deep-orange-strong ml-4">Cохранить изменения</div>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="rgba-brown-strong white-text">
        <tr class="text-center text-uppercase">
            <th scope="col">ID</th>
            <th scope="col">Ссылка товара</th>
            <th scope="col">Название товара</th>
            <th scope="col">Ошибки</th>
            <th scope="col">Проблема</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($myposts as $post) {
            setup_postdata($post);
?>
                <tr>
                        <th scope="row" class="text-center"><?php print $post->ID; ?></th>
                        <td><?php the_permalink(); ?></td>
                        <td><?php the_title(); ?></td>
                        <td class="text-center">
                            <span class="fa fa-close text-danger checkbox-result_<?php print $post->ID; ?>"></span>
                        </td>
                        <td class="text-center"><span id="<?php print $post->ID; ?>" class="btn btn-sm rgba-green-strong btnSaveCheck">Изменить</span></td>
                      </tr>
        <?php } ?>

        </tbody>
    </table>
</div>
