<div class="mt-4">
    <h2 class="text-center">Счетчики Яндекс метрики и Google Analytics</h2>

    <div class="d-flex justify-content-around">
        <!--Yandex-->
        <div class="card text-center p-0 col-12 col-lg-6 col-md-6 col-sm-12 mx-2" style="max-width: 500px;">
            <div class="card-header bg-light text-uppercase">Yandex счетчик</div>
            <div class="card-body d-flex flex-column justify-content-center">
                <?php
                $countYandex = get_option('counter_code_yandex');
                if (strlen($countYandex) !== 8) {
                    echo "<div class='text-black-50 mb-2'>цифр должно быть 8 а не " . strlen($countYandex) . "</div>";
                }
                if ($countYandex && (strlen($countYandex) >= 8)) {
                    $textCountYandex = "<span class='d-inline-flex success-color text-white px-2 rounded'>" . $countYandex . "</span>";
                    $disableButtonYandex = 'd-none';
                    $countQuestionYandex = "<span class='removeCounterYandex' style='cursor:pointer'><i class='fa fa-close green-text mx-2'> Ввести новый код?</i></span>";
                } elseif (strlen($countYandex) === 0) {
                    $textCountYandex = "<span class='text-danger'>Нет</span>";
                } else {
                    $textCountYandex = "<span class='text-uppercase danger-color text-white px-2 rounded'>" . $countYandex . "</span>";
                    $disableButtonYandex = '';
                    $countQuestionYandex = '';
                }
                ?>
                <h4 class="card-title">Текущий счетчик: <?php print $textCountYandex; ?></h4>
                <p class="card-text">Здесь нужно добавить лишь номер из яндекс метрики. Который содержится в строке
                    <code>https://mc.yandex.ru/watch/<code class="font-small bg-dark">31398333</code></code></p>
                <?php echo $countQuestionYandex; ?>
                <div class="fieldCounterYandex <?php echo $disableButtonYandex ?>">
                    <input id="countPutYandex" type="number" placeholder="Введите код счетчика" class="w-50" required/>
                    <button class="btnSaveYandex btn btn-success btn-sm" type="button">Сохранить</button>

                    <div class="border mt-2 d-flex align-items-center justify-content-around">
                        <div class="justify-content-around align-items-center d-flex">
                            <input id="yandexShow" type="hidden" value="<?=get_option('counter_code_yandex_show') ?>">
                            <?php
                            if(get_option('counter_code_yandex_show') == 1){
                                echo '<span class="text-success">показывается</span>';
                            }else{
                                echo '<span class="text-danger">скрыт</span>';
                            }
                            ?>

                        </div>
                        <button class="btnSaveYandexShow btn btn-grey btn-sm" type="button"><?= get_option('counter_code_yandex_show') == 1 ? 'скрыть ' : 'показать ' ?> счетчик</button>
                    </div>
                </div>
            </div>
        </div>
        <!--/Yandex-->

        <!--Google-->
        <div class="card text-center p-0 col-12 col-lg-6 col-md-6 col-sm-12 mx-2" style="max-width: 500px;">
            <div class="card-header bg-light text-uppercase">Google analytics</div>
            <div class="card-body d-flex flex-column justify-content-center">
                <?php
                $countGoogle = get_option('counter_code_google');
                if (strlen($countGoogle) !== 14) {
                    echo "<div class='text-black-50 mb-2'>Символов должно быть 14 а не " . strlen($countGoogle) . "</div>";
                }
                if ($countGoogle && (strlen($countGoogle) >= 14)) {
                    $textCountGoogle = "<span class='d-inline-flex success-color text-white px-2 rounded'>" . $countGoogle . "</span>";
                    $disableButtonGoogle = 'd-none';
                    $countQuestionGoogle = "<span class='removeCounterGoogle' style='cursor:pointer'><i class='fa fa-close green-text mx-2'> Ввести новый код?</i></span>";
                } elseif (strlen($countGoogle) === 0) {
                    $textCountGoogle = "<span class='text-danger'>Нет</span>";
                } else {
                    $textCountGoogle = "<span class='text-uppercase danger-color text-white px-2 rounded'>" . $countGoogle . "</span>";
                    $disableButtonGoogle = '';
                    $countQuestionGoogle = '';
                }
                ?>
                <h4 class="card-title">Текущий счетчик: <?php print $textCountGoogle; ?></h4>
                <p class="card-text">Здесь нужно добавить лишь код из Гугл аналитики. Пример кода будет такой <code>gtag(config,
                        <code class="font-small bg-dark">UA-160696811-1</code>);</code></p

<!--                --><?php //echo $countQuestionGoogle; ?>

                <div class="fieldCounterGoogle">
                    <input id="countPutGoogle" type="text" placeholder="Введите код счетчика" class="w-50" required/>
                    <button class="btnSaveGoogle btn btn-success btn-sm" type="button">Сохранить</button>

                    <div class="border mt-2 d-flex align-items-center justify-content-around">
                        <div class="justify-content-around align-items-center d-flex">
                            <span class="text-success">показывается</span>
                        </div>
                        <button class="btnSaveGoogleShow btn btn-grey btn-sm" type="button">Отключить счетчик</button>
                    </div>
                </div>

            </div>
        </div>
        <!--/Google-->
    </div>
</div>

