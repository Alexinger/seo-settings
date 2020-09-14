<?php
require_once __DIR__ . '/../inc/data/dbConnect.php';

### Общее Количество постов
function get_totalposts() {
	global $wpdb;
	$totalposts = intval($wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'post' AND post_status = 'publish'"));

	echo $totalposts;
}

### Общее Количество страниц
function get_totalpages() {
	global $wpdb;
	$totalpages = intval($wpdb->get_var("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type = 'page' AND post_status = 'publish'"));

	echo $totalpages;
}

### Общее Количество комментариев
function get_totalcomments() {
	global $wpdb;
	$totalcomments = intval($wpdb->get_var("SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_approved = '1'"));

	echo $totalcomments;
}

### Общее Количество комментаторов
function get_totalcommentposters() {
	global $wpdb;
	$totalcommentposters = intval($wpdb->get_var("SELECT COUNT(DISTINCT comment_author) FROM $wpdb->comments WHERE comment_approved = '1' AND comment_type = ''"));

	echo $totalcommentposters;
}

### Общее Количество ссылок
function get_totallinks() {
	global $wpdb;
	$totallinks = intval($wpdb->get_var("SELECT COUNT(link_id) FROM $wpdb->links"));

	echo $totallinks;
}
?>
<table class="table table-hover table-bordered table-sm">
                        <thead>
                        <tr class="text-center">
                            <th scope="col">#</th>
                            <th scope="col">Название</th>
                            <th scope="col">Параметр</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row" class="text-center">1</th>
                            <td>URL главной страницы</td>
                            <td><?php echo home_url(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">2</th>
                            <td>Название блога</td>
                            <td><?php bloginfo(name); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">3</th>
                            <td>Короткое описание</td>
                            <td><?php bloginfo(description); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">4</th>
                            <td>Текущая версия WP</td>
                            <td><?php bloginfo(version); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">5</th>
                            <td>Название текущей темы</td>
                            <td class="text-capitalize"><?php echo get_stylesheet(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">6</th>
                            <td>Email администратора</td>
                            <td><?php bloginfo(admin_email); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">7</th>
                            <td>Какая тема используется?</td>
                            <td><?php if(is_child_theme()){ echo "Дочерняя тема"; } else {echo "Основная тема";} ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">8</th>
                            <td>Количество и время запросва к БД</td>
                            <td><?php echo get_num_queries(); ?> запросов за <?php timer_stop(1); ?> seconds.</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">9</th>
                            <td>Max размер загружаемого файла</td>
                            <td><?php echo ini_get('post_max_size'); ?>b</td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">10</th>
                            <td>Версия PHP</td>
                            <td><?php echo phpversion(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">11</th>
                            <td>Количество зарег. пользователей</td>
                            <td><?php $usercount = count_users(); echo $usercount['total_users'];  ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">12</th>
                            <td>Валюта интернет магазина</td>
                            <td><?php if(function_exists(get_woocommerce_currency)) { echo get_woocommerce_currency(); } else { echo "не используется!"; }  ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">13</th>
                            <td>Страниц на сайте</td>
                            <td><?php get_totalpages(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">14</th>
                            <td>Постов на сайте</td>
                            <td><?php get_totalposts(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">15</th>
                            <td>Коментариев</td>
                            <td><?php get_totalcomments(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">16</th>
                            <td>Коментаторов</td>
                            <td><?php get_totalcommentposters(); ?></td>
                        </tr>
                        <tr>
                            <th scope="row" class="text-center">17</th>
                            <td>Ссылок на сайте</td>
                            <td><?php get_totallinks(); ?></td>
                        </tr>
                        </tbody>
                    </table>
