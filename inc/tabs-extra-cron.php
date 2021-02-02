<?php
mb_internal_encoding("UTF-8");
define('TELEGRAM_TOKEN', '1384324426:AAHIMNA_wPUBEfabuTbBDjHWODyH9AqshGs');
define('TELEGRAM_CHATID', '344920426'); // @name_chat
?>

    <h2 class="text-center">Проверка доступности сайтов</h2>

<?php

if (wp_verify_nonce($_POST['fileup_nonce'], 'my_file_upload')) {

    if (!function_exists('wp_handle_upload'))
        require_once(ABSPATH . 'wp-admin/includes/file.php');

    $file = &$_FILES['my_file_upload'];

    $overrides = ['test_form' => false];

    $movefile = wp_handle_upload($file, $overrides);

    move_uploaded_file($_FILES['user_file']['tmp_name'], plugin_dir_url(__FILE__) . $file);

    if ($movefile && empty($movefile['error'])) {
        echo "Файл был успешно загружен.\n";
        print_r($movefile);
    } else {
        echo "Нет файла для загрузки!\n";
    }
}

$files = "data3.json";
$a = file_get_contents($files, true);
$a = json_decode($a, true);
$set = '';
// unset($files);

if ($a != false) {
    foreach ($a as $k => $e) {
        $set .= $e . '<br>';
    }
}

?>
    <h4 class="mt-3 font-weight-bold text-monospace mb-n1">Список всех сайтов:</h4>
    <small class="text-black-50">(все сайты вводить с новой строки)</small>
    <form action="" method="post" class="mt-3">
        <textarea name="message" class="card m-0 p-3" rows="20"
                  cols="80"><?php echo get_option("site_all"); ?></textarea>
        <p class="mt-3"><input type="submit" name="submit" id="submit" class="btn btn-sm btn-success"
                               value="сохранить изменения"></p>
        <p class="mt-3"><input type="submit" name="submit_update" id="submit_update" class="btn btn-sm btn-danger"
                               value="проверить все сайты"></p>
    </form>

<?php

if (isset($_POST['submit_update'])) {
    $sites = get_option("site_all");
    startMessageTelegram($sites);
}

if (isset($_POST['submit'])) {
    $set = get_option("site_all");
    $txt = str_word_count($set, 1, ":./");
    $event = $_POST['message'];

    foreach ($txt as &$item) {
        isDomainAvailible($item);
    }

    update_option("site_all", $event);
    startMessageTelegram($event);

    ?>
    <script>window.location.reload()</script>
    <?php
}

// /home/alexing/x-ali.ru/www/wp-content/plugins/seo-settings/inc

function startMessageTelegram($message_telegram)
{
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot' . TELEGRAM_TOKEN . '/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => TELEGRAM_CHATID,
                'text' => $message_telegram,
                'parse_mode' => html
            ),
        )
    );
    curl_exec($ch);
}

function isDomainAvailible($domain)
{
    //проверка на валидность урла
    if (!filter_var($domain, FILTER_VALIDATE_URL)) {
        return false;
    }
    //инициализация curl
    $curlInit = curl_init($domain);
    curl_setopt($curlInit, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($curlInit, CURLOPT_HEADER, true);
    curl_setopt($curlInit, CURLOPT_NOBODY, true);
    curl_setopt($curlInit, CURLOPT_RETURNTRANSFER, true);
    //получение ответа
    $response = curl_exec($curlInit);
    curl_close($curlInit);
    if ($response) {
        // return "<b>Сайт работает: </b>" . $domain;
        // startMessageTelegram(`Сайт работает: {$response}`);
        startMessageTelegram($domain . ' - сайт работает!!!');
    } else {
        // echo "<b>Сайт НЕ работает: </b>" . $domain . "<br>";
        // startMessageTelegram(`Сайт НЕ работает: {$response}`);
        startMessageTelegram($domain . 'Сайт НЕЕЕЕ работает!!!');
    }
}





