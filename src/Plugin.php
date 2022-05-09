<?php

namespace Hyperion\Api2pdf;

class Plugin
{
    public const CONVERT_HTML_TO_PDF_ACTION = 'convert_html_to_pdf';
    public const API2PDF_APIKEY_OPTION = 'api2pdf_apikey_option';

    public static function init()
    {
        do_action(self::CONVERT_HTML_TO_PDF_ACTION, 'Hyperion\Api2pdf\Service\Api2PdfService::convertHtmlToPdf', 3);
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