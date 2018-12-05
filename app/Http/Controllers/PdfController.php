<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;


class PdfController extends Controller
{
    function pdfGenerator() {

        // Fill form with data array
        $pdf = new Pdf('pdf_file/TT2_form.pdf');
        $dataArray = [
            'Name'=>'John Doe',
            'Mobile' => '0932857032',
            'Email' => 'johnDoe@hipr.com'
        ];

        $pdf->fillForm($dataArray)
            ->needAppearances();

        if (!$pdf->saveAs('pdf_file/filled.pdf')) {
            $error = $pdf->getError();
            echo $error;
        }

        return response()->download('pdf_file/filled.pdf')->deleteFileAfterSend();
    }

}
