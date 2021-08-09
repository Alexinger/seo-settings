<?php
$upload_dir = (object)wp_upload_dir();
$list = list_files($upload_dir->basedir . '/recvizit', 2);

if (get_option('day_number')) {
    get_option('day_number');
} else {
    add_option('day_number', 7);
}

?>

<div class="card-group bg-white border rounded p-3 my-2">
    <div class="border-bottom border-dark text-center w-100 pb-2">
        <h4 class="w-100 font-weight-bold text-center mt-4">Загруженные реквизиты на сайт в папке (recvizit)</h4>
        <code><?php echo $upload_dir->baseurl ?>/recvizit</code>
        <form id="formDay" style="display: flex;justify-content: space-between;align-items: center;margin: 1rem 0;background: beige;padding: 1.5rem;border-radius: 5px;box-shadow: 1px 1px 5px #bbbbbb;border: 1px solid grey;">
            <div>
                <label>Введит кол-во дней, после которой нужно удалять сохраненные файлы</label>
                <input id="day_number" type="number" style="width: 50px" name="day_number" value="<?php echo get_option('day_number') ?>">
            </div>
            <button id="countDay" type="submit" class="btn btn-green countDay">Сохранить</button>
        </form>
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


        echo '<div class="text-right border-top mt-2">Размер папки: ' . number_format($mb / (1024 * 1024), 1) . ' MB' . '</div>';

        ?>
    </div>
</div>
