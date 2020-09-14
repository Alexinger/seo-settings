jQuery(document).ready(function ($) {
    $("#main-wrapper").addClass("row-fluid");

    // let codeYandexMetrica = $('div.name-option-yandex').data('set');
    // let fullUrlYandex = 'https://mc.yandex.ru/watch/' + codeYandexMetrica;
    // let counterCheck = $("script"),
    //     i = 0;
    // var counter = 0;
    // while (i < counterCheck.length) {
    //     let scriptAll = counterCheck[i].outerHTML,
    //         checkYandex = scriptAll.search(/https:\/\/mc.yandex.ru\/metrika/gm);
    //     if (checkYandex > 0) {
    //         w++;
    //     }
    //     i++;
    // }
    //
    // let codeCounterScr = '<!-- Yandex.Metrika counter -->\n' +
    //     '<script type="text/javascript" >\n' +
    //     '   (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){console.log("test yandex");(m[i].a=m[i].a||[]).push(arguments)};\n' +
    //     '   m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})\n' +
    //     '   (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");\n' +
    //     '\n' +
    //     '   ym(67325179, "init", {\n' +
    //     '        clickmap:true,\n' +
    //     '        trackLinks:true,\n' +
    //     '        accurateTrackBounce:true\n' +
    //     '   });\n' +
    //     '</script>';
    // let noScr = '<noscript><div><img src="https://mc.yandex.ru/watch/67325179" style="position:absolute; left:-9999px;" alt="" /></div></noscript>\n' +
    //     '<!-- /Yandex.Metrika counter -->';
    //
    // if (counter <= 5) {
    //     $("body.home").append(codeCounterScr);
    //     $("body.home")[0].insertAdjacentHTML("beforeend", noScr);
    // }
});
