<?php
if (get_option("counter_code_yandex") != '' || get_option("counter_code_yandex") != null) {
    add_action('wp_footer', 'my_counter_yandex');
    function my_counter_yandex()
    {
        if (get_option('counter_code_yandex_show') == 1 || get_option('counter_code_yandex_show') == '') {
            echo '<!-- Yandex.Metrika counter -->
        <script type="text/javascript">
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(' . get_option("counter_code_yandex") . ', "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true
        });
        <!-- test -->
        </script>
        
        <!-- /Yandex.Metrika counter -->';
        } else {
            return '';
        }
    }
}
