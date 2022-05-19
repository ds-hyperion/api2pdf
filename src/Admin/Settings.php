<?php

namespace Hyperion\API2pdf\Admin;

class Settings
{
    public const SETTINGS_GROUP = 'Api2PdfSettingsGroup';

    public static function createMenu()
    {
        //create new top-level menu
        add_menu_page('Configuration du plugin API2Pdf',
            'API2Pdf',
            'manage_options',
            __DIR__."/SettingsPageView.php"
        );

        //call register settings function
        add_action('admin_init', ['\Hyperion\Api2pdf\Admin\Settings','registerPluginSettings']);
    }

    public static function registerPluginSettings()
    {
        register_setting(self::SETTINGS_GROUP, \Hyperion\Api2pdf\Plugin::API2PDF_APIKEY_OPTION);
    }
}