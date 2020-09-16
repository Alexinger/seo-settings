<?php
add_action('wp_footer', 'my_counter_google');
function my_counter_google()
{
    echo '<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=' . get_option("counter_code_google") . '"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag("js", new Date());

  gtag("config", "' . get_option("counter_code_google") . '");
</script>
';
}
