<?php
use setasign\Fpdi\Fpdi;

class PdfWatermark
{
    public static function addWatermark($filePath, $text)
    {
        // Initialize FPDI
        $pdf = new Fpdi();
        $pageCount = $pdf->setSourceFile($filePath);

        // Process each page
        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);
            $size = $pdf->getTemplateSize($templateId);

            // Add a page with the same orientation and size as the original
            $pdf->AddPage($size['orientation'], [$size['width'], $size['height']]);
            $pdf->useTemplate($templateId);

            // Set font, color, and transparency for the watermark
            $pdf->SetFont('Arial', '', 12);
            $pdf->SetTextColor(128, 128, 128);
            $pdf->SetAlpha(0.5); // Set transparency to 50%

            // Calculate position for watermark (e.g., centered)
            $textWidth = $pdf->GetStringWidth($text);
            $x = ($size['width'] - $textWidth) / 2;
            $y = $size['height'] / 2;

            // Add the watermark text
            $pdf->Text($x, $y, $text);
        }

        // Output the watermarked PDF as a string
        return $pdf->Output('S');
    }
}
