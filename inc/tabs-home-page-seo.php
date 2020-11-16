<!-- Table all pages -->
<?php

global $post;

$args = array('post_type' => array('page', 'attachment'), 'numberposts' => -1, 'nopaging' => true, 'post_mine_type' => 'image', 'post_status' => 'publish', 'order' => 'ASC', 'orderby' => 'title');
$myposts = get_posts($args);

?>
<div class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Все страницы сайта (publish)</h2>
        <div class="btn rgba-deep-orange-strong ml-4">Cохранить изменения</div>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="black white-text">
        <tr class="text-center text-uppercase">
            <th scope="col">ID</th>
            <th scope="col">Ссылка на страницу</th>
            <th scope="col">Описание ошибки или проблемы</th>
            <th scope="col">Ошибки</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($myposts as $post) {
        setup_postdata($post);
        ?>
        <tr>
            <th scope="row" class="text-center idProduct" style="vertical-align: middle;"><?php print $post->ID; ?></th>
            <td><a href="<?php the_permalink(); ?>" target="_blank"><?php the_title(); ?></a></td>
            <td class="w-50"><div id="<?php print $post->ID; ?>" class="editFieldsTasks bg-light contenteditable" contenteditable="true">Здесь можно писать</div></td>
            <td class="text-center" style="vertical-align: middle;">
                <span class="fa fa-close text-danger checkbox-result_<?php print $post->ID; ?>"></span>
            </td>

        </tr>
        <?php } ?>

        </tbody>
        </table>
</div>
