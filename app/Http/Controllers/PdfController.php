<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use mikehaertl\pdftk\Pdf;


class PdfController extends Controller
{
    function pdfGenerator(Request $request) {

        $data = $request->all();

        $formId = $data['formId'];
        $formDataAry = $data['data'];

        // Fill form with data array
        $pdf = new Pdf("pdf_file/uscis_forms/$formId.pdf");


        $pdf->fillForm($formDataAry)
            ->needAppearances();
        $filePath = "pdf_file/uscis_forms/${formId}_filled.pdf";

        if (!$pdf->saveAs($filePath)) {
            $error = $pdf->getError();
            return [
                'status' => '500',
                'error_msg' => $error,
                ];
        }

        return response()->download($filePath)->deleteFileAfterSend();
    }

}
