<?php

/**
 * Add Typekit to login <head>
 */
function krlc2_login_typekit() {
    $files = '<script src="http://use.typekit.com/msu4qap.js"></script>
              <script>try{Typekit.load();}catch(e){}</script>';
    echo $files;
}
add_action('login_head', 'krlc2_login_typekit');

?>