<? if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
|--------------------------------------------------------------------------
| Dwodol Define Constants
|--------------------------------------------------------------------------
|
| awsdabsd asdasd asdasd asdgasda sdasdasy asiduaa
|
*/
define('DWPATH', 						 './dwodol/');
define('DWCOREPATH',				'./dwodol/core/');

	function &dw_load_class ($class, $directory = 'libraries', $prefix = 'Dw_')
	{
		static $_classes = array();

		// Does the class exist?  If so, we're done...
		if (isset($_classes[$class]))
		{
			return $_classes[$class];
		}

		$name = FALSE;


		$path = DWCOREPATH;
		if (file_exists($path.$directory.'/'.$class.EXT))
		{
			$name = $prefix.$class;

			if (class_exists($name) === FALSE)
			{
				require($path.$directory.'/'.$class.EXT);
			}

			break;
		}

		// Did we find the class?
		if ($name === FALSE)
		{
			// Note: We use exit() rather then show_error() in order to avoid a
			// self-referencing loop with the Excptions class
			exit('Unable to locate the specified class: '.$class.EXT);
		}

		// Keep track of what we just loaded
		dw_is_loaded($class);

		$_classes[$class] = new $name();
		return $_classes[$class];
	}
	function dw_is_loaded($class = '')
	{
		static $_is_loaded = array();

		if ($class != '')
		{
			$_is_loaded[strtolower($class)] = $class;
		}

		return $_is_loaded;
	}