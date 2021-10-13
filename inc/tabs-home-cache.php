<?php
//$content_dir = __FILE__ . WP_CONTENT_URL;
//$list = list_files($content_dir->basedir . '/', 3);
/*$list = list_files(WP_CONTENT_DIR . '/cache', 3);*/


?>

<div class="card-group bg-white border rounded p-3 my-2">

    <div class="mt-2 w-100">
<?php
//        $mb = recurse_dirsize($content_dir->basedir . '/');
        /*$mb = recurse_dirsize(WP_CONTENT_DIR . '/cache');
        $s = 0;
        $path = ABSPATH . 'wp-content/cache/autoptimize/';
        unlink($path);
        if ($list[0]) {
            foreach ($list as $item) {
                $s++;
                $str = explode('/', $item);
                $filename = array_pop($str);
                echo $s . ') ' . $filename . '<br>';
                // wp_delete_file(trim($item));
                echo $item . '<br>';
                //home/alexing/x-ali.ru/www/wp-content/uploads/recvizit/2a00bc008800817395a9a0a74b7a6a7_2021-08-30-1.png
                echo $path . '<br>';
//                unlink($path);
            }
        } else {
            echo '<p class="text-monospace text-info">Нет загруженных файлов или они были удалены по сроку хранения!</p>';
        }

        echo '<div class="text-right border-top mt-2">Размер папки: ' . number_format($mb / (1024 * 1024), 1) . ' MB' . '</div>';*/

        ?>
    </div>
    <div>
<!--        --><?php
//        $files = list_files( WP_CONTENT_DIR . '/cache', 3 );
//
//        echo "<pre>";
//        var_dump($files);
//        echo "</pre>";
//        ?>
    </div>

    <?php
        /*$list = list_files(WP_CONTENT_DIR . '/cache', 10);
        if($list[0]){
            foreach ($list as $item){
                echo $item . "<br>";
            }
        }*/

    $dir = WP_CONTENT_DIR;
    echo "DIR: " . $dir . "<br>";
    $mb = recurse_dirsize($dir);
    echo number_format($mb/(1024 * 1024), 1) . " MB";
    /*wp_dlete_file($dir);*/

        /*  /home/alexing/x-ali.ru/www/wp-content/cache/autoptimize/js/index.html
            /home/alexing/x-ali.ru/www/wp-content/cache/autoptimize/index.html
            /home/alexing/x-ali.ru/www/wp-content/cache/autoptimize/css/index.html
        */
    ?>
</div>
