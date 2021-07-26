<?php
$upload_dir = (object)wp_upload_dir();
$list = list_files($upload_dir->basedir . '/recvizit', 2);

?>

<div class="card-group bg-white border rounded p-3 my-2">
    <div class="border-bottom border-dark text-center w-100 pb-2">
        <h4 class="w-100 font-weight-bold text-center mt-4">Загруженные реквизиты на сайт в папке (recvizit)</h4>
        <code><?php echo $upload_dir->baseurl ?>/recvizit</code>
    </div>
    <div class="mt-2 w-100">
        <?php
        $mb = recurse_dirsize($upload_dir->basedir . '/recvizit');
        $s = 0;
        if ($list[0]) {
            foreach ($list as $item) {
                $s++;
                $str = explode('/', $item);
                $filename = array_pop($str);
                echo $s . ') ' . $filename . '<br>';
            }
        } else {
            echo '<p class="text-monospace text-info">Нет загруженных файлов или они были удалены по сроку хранения!</p>';
        }




        echo '<div class="text-right border-top mt-2">Размер папки: ' . number_format($mb/(1024*1024), 1) . ' MB' . '</div>';

        if (true) {
            $upload_info = wp_get_upload_dir();
            $file = $upload_info['basedir'] . '/recvizit/37.25.100.32.png';
            // wp_delete_file($file);
            // var_dump($file);
        }

        ?>
    </div>
</div>
