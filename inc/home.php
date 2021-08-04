<div class="ma-page-plugin">
<div class="block-modal-alert">
    <div class="alert alert-success m-auto justify-content-around d-none" role="alert"></div>
</div>

<div class="pr-3">
    <h1 class="h1 text-center my-3 alert mb-5 text-info font-weight-normal">Настройки оптимизации сайта</h1>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs nav-justified" role="tablist">
        <li class="nav-item">
            <a class="nav-link active text-uppercase text-dark" data-toggle="tab" href="#home" role="tab"><i class="fa fa-home mr-3"></i>Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-uppercase text-dark" data-toggle="tab" href="#edit" role="tab"><i class="fa fa-edit mr-3"></i>Edit</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-uppercase text-dark" data-toggle="tab" href="#tabs" role="tab"><i class="fa fa-clone mr-3"></i>Tabs</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-uppercase text-dark" data-toggle="tab" href="#variables" role="tab"><i class="fa fa-chart-pie mr-3"></i>О Сайте</a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-uppercase text-dark" data-toggle="tab" href="#seo" role="tab"><i class="fa fa-briefcase mr-3"></i>SEO</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content py-1">
        <div class="tab-pane active in" id="home" role="tabpanel">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item mx-1">
                    <a class="nav-link text-dark active" data-toggle="tab" href="#shortcode" role="tab"><i class="fa fa-sitemap mr-3"></i>Шорткоды</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link text-dark" data-toggle="tab" href="#left-menu" role="tab"><i class="fa fa-file mr-3"></i>Files upload</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link text-dark" data-toggle="tab" href="#post-page" role="tab"><i class="fa fa-code-fork mr-3"></i>Post & Page</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link text-dark" data-toggle="tab" href="#counter" role="tab"><i class="fa fa-bullseye mr-3"></i>Счетчики</a>
                </li>
            </ul>

            <div class="tab-content py-3 border-top-0">
                <div class="tab-pane active" id="shortcode" role="tabpanel">

                    <!-- Shortcode tables google sheets -->
	                <?php include_once 'tabs-home-shortcode.php'; ?>

                </div>
                <div class="tab-pane fade" id="left-menu" role="tabpanel">

                    <!-- Контент Боковое меню -->
		            <?php include_once 'tabs-home-amocrm.php'; ?>

                </div>
                <div class="tab-pane fade" id="post-page" role="tabpanel">

                    <!-- Контент Боковое меню -->
                    <?php include_once 'tabs-home-post-page.php'; ?>

                </div>
                <div class="tab-pane fade" id="counter" role="tabpanel">

                    <!-- Контент Настроек -->
		            <?php include_once 'tabs-home-counter.php'; ?>

                </div>
            </div>
        </div>


        <div class="tab-pane fade" id="variables" role="tabpanel">
            <!-- Контент Данные о сайте -->
            <?php include_once 'tabs-home-site.php'; ?>
        </div>


        <div class="tab-pane fade" id="edit" role="tabpanel">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#category-fields" role="tab"><i class="fa fa-th-list mr-3"></i>Поля формы</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#category-tag" role="tab"><i class="fa fa-tag mr-3"></i>Метки</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#category-cron" role="tab"><i class="fa fa-clock-o mr-3"></i>Cron</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#category-style" role="tab"><i class="fa fa-tag mr-3"></i>Стили темы</a>
                </li>
            </ul>

            <div class="tab-content py-3 border-top-0">
                <div class="tab-pane active" id="category-fields" role="tabpanel">

                    <!-- Контент Поля формы заказа -->
	                <?php include_once 'tabs-extra-field-order.php'; ?>

                </div>
                <div class="tab-pane" id="category-tag" role="tabpanel">
                    <!-- Контент Метки -->
	                <?php include_once 'tabs-extra-tag.php'; ?>
                </div>
                <div class="tab-pane" id="category-cron" role="tabpanel">
                    <!-- Контент Cron задач -->
                    <?php include_once 'tabs-extra-cron.php'; ?>
                </div>
                <div class="tab-pane" id="category-style" role="tabpanel">

                    <!-- Контент Дочерние стили текущей темы -->
	                <?php include_once 'tabs-extra-style-theme.php'; ?>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="tabs" role="tabpanel">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#delivery" role="tab"><i class="fa fa-folder-o mr-3"></i><?php if(get_option("tabs-check-delivery-name") !== ''){echo get_option("tabs-check-delivery-name");}else{ echo "Вкладка";}; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#garant" role="tab"><i class="fa fa-folder-o mr-3"></i><?php if(get_option("tabs-check-garant-name") !== ''){echo get_option("tabs-check-garant-name");}else{ echo "Вкладка";}; ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" data-toggle="tab" href="#bay" role="tab"><i class="fa fa-folder-o mr-3"></i><?php if(get_option("tabs-check-bay-name") !== ''){echo get_option("tabs-check-bay-name");}else{ echo "Вкладка";}; ?></a>
                </li>
            </ul>

            <!-- Контент Дочерние стили текущей темы -->
	        <?php include_once 'tabs-tab-delivery-garant-bay.php'; ?>

        </div>

        <!-- Контент Данные о сайте -->
        <div class="tab-pane fade" id="seo" role="tabpanel">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item mx-1">
                    <a class="nav-link text-dark" data-toggle="tab" href="#pagespeed" role="tab"><i class="fa fa-bolt mr-3"></i>PageSpeed</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link text-dark" data-toggle="tab" href="#prcy" role="tab"><i class="fa fa-code-fork mr-3"></i>PR-CY</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link text-dark" data-toggle="tab" href="#postseo" role="tab"><i class="fa fa-window-restore mr-3"></i>Post check</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link text-dark" data-toggle="tab" href="#pageseo" role="tab"><i class="fa fa-window-restore mr-3"></i>Page check</a>
                </li>
                <li class="nav-item mx-1">
                    <a class="nav-link active text-dark" data-toggle="tab" href="#productseo" role="tab"><i class="fa fa-window-restore mr-3"></i>Product check</a>
                </li>
            </ul>

            <div class="tab-content py-3 border-top-0">
                <div class="tab-pane fade" id="pagespeed" role="tabpanel">
                    <!-- Страница seo проверки сайта на скорость pagespeed insights -->
                    <?php include_once 'tabs-home-seo.php'; ?>
                </div>
                <div class="tab-pane fade" id="prcy" role="tabpanel">
                    <!-- Страница seo проверки сайта на скорость pr-cy.ru -->
                    <?php include_once 'tabs-home-prcy.php'; ?>
                </div>
                <div class="tab-pane fade" id="pageseo" role="tabpanel">
                    <!-- Страница seo проверки сайта на скорость pr-cy.ru -->
                    <?php include_once 'tabs-home-page-seo.php'; ?>
                </div>
                <div class="tab-pane fade" id="postseo" role="tabpanel">
                    <!-- Страница seo проверки сайта на скорость pr-cy.ru -->
                    <?php include_once 'tabs-home-post-seo.php'; ?>
                </div>
                <div class="tab-pane active" id="productseo" role="tabpanel">
                    <!-- Страница seo проверки сайта на скорость pr-cy.ru -->
                    <?php include_once 'tabs-home-product-seo.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php

