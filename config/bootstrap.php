<?php
/**
 * Shudowner bootstrap
 *
 * This registers a shutdown function, and uses `fastcgi_finish_request` befere running the actions.
 * The actions should therefore never output anything as sending it to the browser is not guaranteed.
 */
use lithium\core\Libraries;


$lib = Libraries::get('li3_shutdown');
register_shutdown_function($lib['prefix'] . 'extensions\Shutdowner::shutdown');

?>