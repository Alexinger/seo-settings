<?php


?>

<!-- Default form contact -->
<form class="text-center border border-light p-5 bg-white" action="<?php echo plugins_url('seo-settings/inc/data/request.php') ?>" method="post">

    <p class="h4 mb-4">Настройка шаблона страницы (Landing page)</p>

<div class="d-flex" style="column-gap: 15px">
    <!-- Название сайта -->
    <div class="d-flex align-items-baseline w-100">
        <label for="nameSite" class="mr-3 no-break">Название сайта</label>
        <input type="text" id="nameSite" name="nameSite" class="form-control mb-4" placeholder="Название сайта" value="<?php echo get_option("site_title"); ?>">
    </div>
    <!-- Название шаблона меню -->
    <div class="d-flex align-items-baseline w-100">
        <label for="nameTemplate" class="mr-3 no-break">Название шаблона меню</label>
        <input type="text" id="nameTemplate" class="form-control mb-4" placeholder="Название верхнего меню">
    </div>
    <!-- Номер телефона -->
    <div class="d-flex align-items-baseline w-100">
        <label for="phone" class="mr-3 no-break">Номер телефона</label>
        <input type="tel" id="phone" class="form-control mb-4" placeholder="Номер телефона">
    </div>
</div>
<hr>
<div class="d-flex" style="column-gap: 15px">
    <!-- Цвет верхнего меню -->
    <div class="d-flex align-items-baseline w-100">
        <label for="label3" class="mr-3 no-break">Цвет верхнего меню</label>
        <input type="color" id="inp3" class="form-control mb-4 w-25" placeholder="Name">
    </div>
    <!-- Цвет фона сайта -->
    <div class="d-flex align-items-baseline w-100">
        <label for="label4" class="mr-3 no-break">Цвет фона сайта</label>
        <input type="color" id="inp4" class="form-control mb-4 w-25" placeholder="Name">
    </div>
    <!-- Цвет подвала сайта -->
    <div class="d-flex align-items-baseline w-100">
        <label for="label5" class="mr-3 no-break">Цвет подвала сайта</label>
        <input type="color" id="inp5" class="form-control mb-4 w-25" placeholder="Name">
    </div>
</div>
<hr>
<div class="d-flex" style="column-gap: 15px">
    <!-- Name -->
    <input type="text" id="inp6" class="form-control mb-4" placeholder="Name">
    <!-- Email -->
    <input type="email" id="inp7" class="form-control mb-4" placeholder="E-mail">
    <!-- Name -->
    <input type="text" id="inp8" class="form-control mb-4" placeholder="Name">
</div>
   
    <!-- Message -->
    <div class="form-group">
        <textarea class="form-control rounded-0" id="exampleFormControlTextarea2" rows="3" placeholder="Message"></textarea>
    </div>

    <!-- Send button -->
    <button class="btn btn-info btn-block" type="submit">Сохранить изменения шаблона</button>

</form>
<!-- Default form contact -->

<hr>

<div class="wrap">
    <h2>Your Plugin Name</h2>

    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>

        <table class="form-table">

            <tr valign="top">
                <th scope="row">New Option Name</th>
                <td><input type="text" name="new_option_name" value="<?php echo get_option('new_option_name'); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">Some Other Option</th>
                <td><input type="text" name="some_other_option" value="<?php echo get_option('some_other_option'); ?>" /></td>
            </tr>

            <tr valign="top">
                <th scope="row">Options, Etc.</th>
                <td><input type="text" name="option_etc" value="<?php echo get_option('option_etc'); ?>" /></td>
            </tr>

        </table>

        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="new_option_name,some_other_option,option_etc" />

        <p class="submit">
            <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
        </p>

    </form>
</div>

<?php
$get = plugin_dir_url(__DIR__) . 'inc/googlesheet/index.php';
// echo $get;
// include_once $get . 'inc/googlesheet/index.php';

?>
