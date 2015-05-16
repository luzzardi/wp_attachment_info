<?php

class AttachmentInfo_Admin
{

    static private $initialized = false;

    static public function init()
    {
        if (self::$initialized === false) {
            self::initHooks();
        }
    }

    static public function initHooks()
    {
        self::$initialized = true;

        load_plugin_textdomain(_ATTACHMENT_INFO__PLUGIN_DOMAIN);

        self::requireAdminClasses();

        add_action('admin_menu', array('AttachmentInfo_Admin', 'adminMenu'));
        add_action('admin_post_getAttachmentInfo-'._ATTACHMENT_INFO__PLUGIN_DOMAIN, array('AttachmentInfo_Admin_Controller', 'getAttachmentInfo'));
        add_action('admin_head', array('AttachmentInfo_Admin', 'adminHead'));
    }

    static public function adminMenu()
    {
        if (function_exists('add_menu_page')) {
            add_menu_page(__(_ATTACHMENT_INFO__PLUGIN_TITLE, _ATTACHMENT_INFO__PLUGIN_DOMAIN), __(_ATTACHMENT_INFO__PLUGIN_TITLE, _ATTACHMENT_INFO__PLUGIN_DOMAIN), 'manage_options', _ATTACHMENT_INFO__PLUGIN_DOMAIN . '-index', array('AttachmentInfo_Admin_Controller', 'index'), 'dashicons-archive', '6.5');
            add_submenu_page(_ATTACHMENT_INFO__PLUGIN_DOMAIN . '-index', __('All', _ATTACHMENT_INFO__PLUGIN_DOMAIN), __('All', _ATTACHMENT_INFO__PLUGIN_DOMAIN), 'manage_options', _ATTACHMENT_INFO__PLUGIN_DOMAIN . '-index' );
        }

    }

    static public function adminHead()
    {
      self::enqueue();
    }

    static public function enqueue()
    {
      if (!isset($_GET['page'])) {
        return;
      }
      $page = explode('-', $_GET['page']);
      $view = $page[1];
      $page = $page[0];
      if ($page == _ATTACHMENT_INFO__PLUGIN_DOMAIN) {
        self::load('js', $view);
      }
    }

    static public function load($type, $filename)
    {
      $folder = _ATTACHMENT_INFO__PLUGIN_URL . 'admin/public/'.$type.'/';
      wp_enqueue_script('js-'._ATTACHMENT_INFO__PLUGIN_DOMAIN.'-'.$filename, $folder . $filename . '.js', array('jquery'), _ATTACHMENT_INFO__VERSION, true );
    }

    static private function requireAdminClasses()
    {
        require_once(_ATTACHMENT_INFO__PLUGIN_DIR . 'admin/class.admin-controller.php');
    }

}
