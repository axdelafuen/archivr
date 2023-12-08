<?php
class Autoload
{
    private static $instance = null;

    public static function load()
    {
        if (null !== self::$instance) {
            throw new RuntimeException(sprintf('%s is already started', __CLASS__));
        }

        self::$instance = new self();

        if (!spl_autoload_register(array(self::$instance, '_autoload'))) {
            throw new RuntimeException(sprintf('%s : Could not start the autoload', __CLASS__));
        }
    }

    public static function shutDown()
    {
        if (null !== self::$instance) {

            if (!spl_autoload_unregister(array(self::$instance, '_autoload'))) {
                throw new RuntimeException('Could not stop the autoload');
            }

            self::$instance = null;
        }
    }

    private static function _autoload($class)
    {
        global $rep;
        $filename = $class . '.php';
        $dir = array('models/', './', 'config/', 'controller/', 'businesses/');
        foreach ($dir as $d) {
            $file = $rep . $d . $filename;
            if (file_exists($file)) {
                include_once $file;
            }
        }

    }
}
