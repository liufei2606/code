<?php

// +---------------------------------------------------------------------------+
// | This file is part of the core package.                                    |
// | Copyright (c) laiketui.com                                                |
// |                                                                           |
// | For the full copyright and license information, please view the LICENSE   |
// | file that was distributed with this source code. You can also view the    |
// | LICENSE file online at http://www.laiketui.com                            |
// +---------------------------------------------------------------------------+

function LaikeAuto($class){
    // this static variable is generated by the $config file below
    static $classes;

    if (!isset($classes))
    {

        try
        {

            // include the list of autoload classes
            $config = ConfigCache::checkConfig('config/autoload.ini');

        } catch (MojaviException $e)
        {

            $e->printStackTrace();

        } catch (Exception $e)
        {

            // unknown exception
            $e = new MojaviException($e->getMessage());

            $e->printStackTrace();

        }

        require_once($config);

    }

    if (!isset($classes[$class]))
    {

        // unspecified class
        $error = 'Autoloading of class "%s" failed';
        $error = sprintf($error, $class);
        $e     = new AutoloadException($error);

        $e->printStackTrace();

    }

    // class exists, let's include it
    require_once($classes[$class]);
}

spl_autoload_register('LaikeAuto');

try
{

    error_reporting(MO_ERROR_REPORTING);

    // ini settings
    ini_set('arg_separator.output',      '&amp;');
    ini_set('display_errors',            1);
    ini_set('magic_quotes_runtime',      0);
    ini_set('unserialize_callback_func', '__autoload');

    // define a few filesystem paths
    define('MO_CONFIG_DIR',   MO_WEBAPP_DIR . '/config');
    define('MO_LIB_DIR',      MO_WEBAPP_DIR . '/lib');
    define('MO_MODULE_DIR',   MO_WEBAPP_DIR . '/modules');
    define('MO_TEMPLATE_DIR', MO_WEBAPP_DIR . '/templates');

    // required files
    require_once(MO_APP_DIR . '/version.php');

    // required classes for this file and ConfigCache to run
    require_once(MO_APP_DIR . '/core/MojaviObject.class.php');
    require_once(MO_APP_DIR . '/util/ParameterHolder.class.php');
    require_once(MO_APP_DIR . '/config/ConfigCache.class.php');
    require_once(MO_APP_DIR . '/config/ConfigHandler.class.php');
    require_once(MO_APP_DIR . '/config/ParameterParser.class.php');
    require_once(MO_APP_DIR . '/config/IniConfigHandler.class.php');
    require_once(MO_APP_DIR . '/config/AutoloadConfigHandler.class.php');
    require_once(MO_APP_DIR . '/config/RootConfigHandler.class.php');
    require_once(MO_APP_DIR . '/exception/MojaviException.class.php');
    require_once(MO_APP_DIR . '/exception/AutoloadException.class.php');
    require_once(MO_APP_DIR . '/exception/CacheException.class.php');
    require_once(MO_APP_DIR . '/exception/ConfigurationException.class.php');
    require_once(MO_APP_DIR . '/exception/ParseException.class.php');
    require_once(MO_APP_DIR . '/util/Toolkit.class.php');

    // clear our cache if the conditions are right
    if (MO_DEBUG)
    {

        ConfigCache::clear();

    }

    // load base settings
    ConfigCache::import('config/settings.ini');

    // required classes for the framework
    ConfigCache::import('config/compile.conf');

} catch (MojaviException $e)
{

    $e->printStackTrace();

} catch (Exception $e)
{

    // unknown exception
    $e = new MojaviException($e->getMessage());

    $e->printStackTrace();

}

?>
