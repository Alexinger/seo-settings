<?php
$site = site_url();
?>

<!--Table all pages-->
<div class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Все страницы сайта</h2>
        <div class="btn rgba-deep-orange-strong ml-4">Cохранить изменения</div>
    </div>
    <table class="table table-bordered table-hover">
        <thead class="black white-text">
        <tr class="text-center text-uppercase">
            <th scope="col">ID</th>
            <th scope="col">Ссылка страницы</th>
            <th scope="col">Название страницы</th>
            <th scope="col">Ошибки</th>
            <th scope="col">Проблема</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $pages = get_pages();
        foreach( $pages as $page ){
            if($page->post_status === 'publish'){
                echo '<tr>
                        <th scope="row" class="text-center">'. $page->ID .'</th>
                        <td>' . get_page_link( $page->ID ) . '</td>
                        <td>' . esc_html($page->post_title) . '</td>
                        <td class="text-center">
                            <span class="fa fa-check text-success checkbox-result_' . $page->ID . '"></span>
                        </td>
                        <td class="text-center"><span id="' . $page->ID . '" class="btn btn-sm rgba-green-strong btnSaveCheck">Изменить</span></td>
                      </tr>';
            }
        }
        ?>

        </tbody>
        </table>
</div>

<hr class="my-5" style="border-width: thick;border-color: rebeccapurple;">

<!--Table all posts-->
<div class="mt-4">
    <h2>Все посты сайта</h2>
    <table class="table table-bordered table-hover">
        <thead class="blue-grey white-text">
        <tr class="text-center text-uppercase">
            <th scope="col">ID</th>
            <th scope="col">Ссылка постов</th>
            <th scope="col">Название поста</th>
            <th scope="col">Ошибки</th>
            <th scope="col">Проблема</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $pages = get_posts();
        foreach( $pages as $page ){
            if($page->post_status === 'publish'){
                echo '<tr>
                        <th scope="row" class="text-center">'. $page->ID .'</th>
                        <td>' . get_page_link( $page->ID ) . '</td>
                        <td>' . esc_html($page->post_title) . '</td>
                        <td class="text-center">
                            <span class="fa fa-close text-danger checkbox-result_' . $page->ID . '"></span>
                        </td>
                        <td class="text-center"><span id="' . $page->ID . '" class="btn btn-sm rgba-green-strong btnSaveCheck">Изменить</span></td>
                      </tr>';
            }
        }
        ?>

        </tbody>
    </table>
</div>
