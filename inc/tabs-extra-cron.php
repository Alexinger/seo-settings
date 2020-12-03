<h2 class="text-center">Проверка доступности сайтов</h2>

<button class="btn btn-dark-green rounded">Проверить</button>

<?php

mb_internal_encoding("UTF-8");
define('TELEGRAM_TOKEN', '1384324426:AAHIMNA_wPUBEfabuTbBDjHWODyH9AqshGs');
define('TELEGRAM_CHATID', '344920426'); // @name_chat
// define('API_URL', 'https://api.telegram.org/bot' . TOKEN . '/');

//isDomainAvailible('https://google.com');
//isDomainAvailible('https://ibank.biz.ua');
//isDomainAvailible('http://goog32434235254636leasd.com');

//isDomainAvailible("https://2969.ru");
//isDomainAvailible("https://ig-na.ru");
//isDomainAvailible("https://stosuper.ru");
//isDomainAvailible("https://2307.ru");
//isDomainAvailible("https://2284.ru/chat-widget");

// почта
//isDomainAvailible("https://2301.ru");
//isDomainAvailible("https://mailpo.ru");
//isDomainAvailible("http://2218.ru");

// незамерзайка
//isDomainAvailible("https://nezamerzaev.ru");
//isDomainAvailible("https://nezamerzajka-optom.ru");
//isDomainAvailible("https://avto-voda.ru");
//isDomainAvailible("http://voda-avto.ru");
//isDomainAvailible("https://nezamerzaev-30.ru");
//isDomainAvailible("https://nezamerzajka-moskva.ru");
//isDomainAvailible("https://nezamerzaika24.ru");
//isDomainAvailible("https://nezamerzajka-spb.ru");
//isDomainAvailible("https://nezamerzaika-optom-spb.ru");
//isDomainAvailible("https://nezamerzaika-samara.ru");
//isDomainAvailible("https://nezamerzajka-samara.ru");
//isDomainAvailible("https://nezamerzaika-nsk.ru");
//isDomainAvailible("https://nezamerzajka-novosibirsk.ru");
//isDomainAvailible("https://nezamerzaika-ekb.ru");
//isDomainAvailible("https://nezamerzajka-ekaterinburg.ru");
//isDomainAvailible("https://nezamerzaika-kazan.ru");
//isDomainAvailible("https://nezamerzajka-optom-kazan.ru");
//isDomainAvailible("https://nezamerzajka-ufa.ru");
//isDomainAvailible("https://nezamerzajka-optom-ufa.ru");
//isDomainAvailible("https://nezamerzaika-perm.ru");
//isDomainAvailible("https://nezamerzajka-optom-perm.ru");

// двигатели
//isDomainAvailible("https://dvigatelev.ru");
//isDomainAvailible("https://remont-dvigatelej.ru");
//isDomainAvailible("https://remont-motora.ru");
//isDomainAvailible("https://vazdvigatel.ru");
//isDomainAvailible("https://vaz-dvigatel.ru");
//isDomainAvailible("https://dvigatelgaz.ru");
//isDomainAvailible("https://gazdvigatel.ru");
//isDomainAvailible("https://avtoservis-yuvao.ru");

// дезсредства
//isDomainAvailible("https://botun.ru");
//isDomainAvailible("https://dezsredstva-optom.ru");

// автосервисы
//isDomainAvailible("https://sto-chita.ru");
//isDomainAvailible("http://avtoservis-karmaks.ru");
//isDomainAvailible("http://avtoservis-rybinsk.ru");
//isDomainAvailible("https://zapchast-bu.ru");

// автошкола
//isDomainAvailible("https://masterclass76.ru");

// ремонт
//isDomainAvailible("https://remont-kvartir-rybinsk.ru");


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
                'parse_mode'=>html
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
    if($response) {
        // return "<b>Сайт работает: </b>" . $domain;
    } else {
        echo "<b>Сайт НЕ работает: </b>" . $domain . "<br>";
    }
}





