<?php

namespace Hyperion\Api2pdf\Service;

use Api2Pdf\Api2Pdf;
use Exception;
use Hyperion\Api2pdf\Plugin;

class Api2PdfService
{
    public static function convertHtmlToPdf(string $html,
                                            bool $directDownload = true,
                                            string $filename = 'fichier.pdf') : ?string
    {
        $apiKey = get_option(Plugin::API2PDF_APIKEY_OPTION);
        if($apiKey === false) {
            throw new Exception("API KEY for API2PDF is not set");
        }

        $apiClient = new Api2Pdf($apiKey);
        $result = $apiClient->chromeHtmlToPdf($html, $directDownload, $filename);

        return $directDownload ? null : $result->getFile();
    }
}