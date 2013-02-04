<?php

namespace li3_shutdown\extensions;

class Shutdowner extends \lithium\core\StaticObject {

	protected static $_actions = array();

	/**
	 * Finish the CGI request and run shutdown actions
	 *
	 * @return
	 */
	public static function shutdown() {
		if(function_exists('fastcgi_finish_request')) {
			fastcgi_finish_request();
		}
		return static::runActions();
	}


	/**
	 * Add an action to be performed
	 *
	 * @param mixed $class either string or object representing the class
	 * @param string $method name of the method to run
	 * @param array $params params to pass to the method
	 */
	public static function addAction($class, $method, array $params = array()) {
		static::$_actions[] = array(
			'class' => $class,
			'method' => $method,
			'params' => $params
		);
	}


	/**
	 * Run all actions
	 *
	 * @return void
	 */
	public static function runActions() {
		foreach(static::$_actions as $doit) {
			call_user_func_array(array($doit['class'], $doit['method']), $doit['params']);
		}
	}

}

?>