<?php
// add_option('counter_code_yandex', '31398333');
// update_option('counter_code_yandex', '3139833');
//    add_option('counter_code_google', '200');



?>

<div class="mt-4">
    <h2 class="text-center">Счетчики Яндекс метрики и Google Analytics</h2>

    <div class="d-flex justify-content-around">
        <!--Yandex-->
        <div class="card text-center p-0 col-12 col-lg-6 col-md-6 col-sm-12 mx-2" style="max-width: 500px;">
            <div class="card-header bg-light text-uppercase">Yandex счетчик</div>
            <div class="card-body d-flex flex-column justify-content-center">
                <?php
                $count = get_option('counter_code_yandex');
                if(strlen($count) !== 8){
                    echo "<div class='text-black-50 mb-2'>цифр должно быть 8 а не " . strlen($count) . "</div>";
                }
                if ($count && (strlen($count) >= 8)) {
                    $textCount = "<span class='success-color text-white px-2 rounded'>" . $count . "</span>";
                    $disableButton = 'd-none';
                    $countQuestion = "<span class='removeCounter' style='cursor:pointer'><i class='fa fa-close green-text mx-2'> Ввести новый код?</i></span>";
                } else {
                    $textCount = "<span class='text-uppercase danger-color text-white px-2 rounded'>" . $count . "</span>";
                    $disableButton = '';
                    $countQuestion = '';
                }
                ?>
                <h4 class="card-title">Текущий счетчик: <?php print $textCount; ?></h4>
                <p class="card-text">Здесь нужно добавить лишь номер из яндекс метрики. Который содержится в строке
                    <code>https://mc.yandex.ru/watch/<code class="font-small bg-dark">31398333</code></code></p>
                <?php echo $countQuestion; ?>
                <div class="fieldCounter <?php echo $disableButton ?>">
                    <input id="countPutYandex" type="number" placeholder="Введите код от счетчика" class="w-50" required/>
                    <button class="btnSaveYandex btn btn-success btn-sm" type="button">Сохранить</button>
                </div>
            </div>
        </div>
        <!--/Yandex-->

        <!--Google-->
        <div class="card text-center p-0 col-12 col-lg-6 col-md-6 col-sm-12 mx-2" style="max-width: 500px;">
            <div class="card-header bg-light text-uppercase">Google analytics</div>
            <div class="card-body d-flex flex-column justify-content-center">
                <h4 class="card-title">Текущий счетчик: <span
                            class="text-uppercase danger-color text-white px-2 rounded">нет</span></h4>
                <p class="card-text">Здесь нужно добавить лишь код из Гугл аналитики. Пример кода будет такой <code>gtag('config',
                        '<code class="font-small bg-dark">UA-160696811-1</code>');</code></p>
                <div>
                    <input type="text" min="8" max="8" placeholder="Введите код аналитики" class="w-50"/>
                    <a class="btn btn-success btn-sm">Сохранить</a>
                </div>
            </div>
        </div>
        <!--/Google-->
    </div>
</div>

