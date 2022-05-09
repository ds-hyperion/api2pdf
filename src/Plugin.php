<?php

namespace Hyperion\Api2pdf;

use Hyperion\Api2pdf\Service\Api2PdfService;

class Plugin
{
    public const CONVERT_HTML_TO_PDF_ACTION = 'convert_html_to_pdf';
    public const API2PDF_APIKEY_OPTION = 'api2pdf_apikey_option';

    public static function init()
    {
        do_action(self::CONVERT_HTML_TO_PDF_ACTION, 'Api2PdfService::convertHtmlToPdf', 3);
        add_menu_page(
            'Configuration du plugin API2Pdf',
            'API2PDF',
            'manage_options',
            'Admin/Config.php'
        );

    }

    public static function install()
    {
        add_option(self::API2PDF_APIKEY_OPTION);
    }

    public static function uninstall()
    {
        // Remove secret from wordpress option
        delete_option(self::API2PDF_APIKEY_OPTION);
    }

}