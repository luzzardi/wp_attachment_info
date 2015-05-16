<?php

class AttachmentInfo
{

    const ADMIN_PATH  = 'admin/';
    static private $initialized = false;

    static public function init()
    {
        if (self::$initialized === false) {
            self::initHooks();
        }
    }

    static private function initHooks()
    {
        self::requireClasses();
    }

    static private function render($isAdmin, $name, $args)
    {
        $args = apply_filters('att_info_view_arguments', $args, $name);

        foreach ( $args AS $key => $val ) {
            $$key = $val;
        }

        $file = _ATTACHMENT_INFO__PLUGIN_DIR;
        if ($isAdmin) {
            $file .= self::ADMIN_PATH;
        }

        $file .= 'views/' . $name . '.phtml';

        ob_start();
        include $file;
        $rendered_view = ob_get_clean();

        return $rendered_view;
    }

    static public function view($name, array $args = array())
    {
        return self::render(false, $name, $args);
    }

    static public function viewAdmin($name, array $args = array())
    {
        echo self::render(true, $name, $args);
    }

    static public function getElement($name)
    {
        return self::openElement(false, $name);
    }

    static public function getAdminElement($name)
    {
        return self::openElement(true, $name);
    }

    static public function requireClasses()
    {
    }


}

?>
