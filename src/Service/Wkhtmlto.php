<?php

namespace Hyperion\Api2pdf\Service;

//use Imagick;
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
    public static function convertToImage(string $html, string $temporaryImageAbsolutePath): void
    {
//        $pdfPath = $temporaryImageAbsolutePath.".pdf";
//        $jpgPath = $temporaryImageAbsolutePath.".jpg";
//        self::convertToPDF($html, $pdfPath);

        $image = new Imagick();
        $image->setResolution(300, 300);
        $image->readImage($temporaryImageAbsolutePath);
        $image->setImageFormat("jpg");
        $image->cropImage(2479, 3506, 0, 0);
        $image->writeImage($temporaryImageAbsolutePath . ".jpg");
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
}
