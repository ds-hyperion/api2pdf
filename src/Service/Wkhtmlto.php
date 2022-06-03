<?php

namespace Hyperion\Api2pdf\Service;

use Imagick;
use mikehaertl\wkhtmlto\Pdf;

class Wkhtmlto
{
    public static function convertToPDF(string $html, string $temporaryPDFAbsolutePath)
    {
        $pdf = self::getPdfWithBaseOptions($html);
        if (!$pdf->saveAs($temporaryPDFAbsolutePath)) {
            throw new \Exception("Impossible de sauvegarder le fichier pdf :" . $pdf->getError());
        }
    }

    /**
     * @throws \ImagickException
     */
    public static function convertToImage(string $temporaryImageAbsolutePath, string $fileName): void
    {
        $pdfPath = $temporaryImageAbsolutePath.".pdf";
        $jpgPath = $temporaryImageAbsolutePath.".jpeg";

        $image = new Imagick();
        $image->setResolution(300, 300);
        $image->readImage($pdfPath);
        $image->setImageFormat("jpeg");
        $jpgPath = self::checkPath($fileName, $jpgPath);
        $image->writeImage($jpgPath);
        $image->clear();
        $image->destroy();
    }

    public static function sendPdf(string $html)
    {
        $pdf = self::getPdfWithBaseOptions($html);
        if (!$pdf->send()) {
            throw new \Exception("Impossible de générer le fichier pdf :" . $pdf->getError());
        }
    }

    private static function getPdfWithBaseOptions(string $html): Pdf
    {
        $options = [
            'binary' => getenv('WKHMTLTOPDF_PATH'),
            'image-quality' => 100,
            'margin-bottom' => 0,
            'margin-left' => 0,
            'margin-right' => 0,
            'margin-top' => 0,
            'disable-smart-shrinking',
            'dpi' => 300,
        ];

        $pdf = new Pdf($html);
        $pdf->setOptions($options);
        return $pdf;
    }

    private static function checkPath(string $filename, string $fullpath): string
    {
        $index = 1;
        while (file_exists($fullpath)) {
            $info = pathinfo($fullpath);
            $fullpath = $info['dirname'] . '/' . $filename
                . '(' . $index++ . ')'
                . '.' . $info['extension'];
        }
        return $fullpath;
    }
}
