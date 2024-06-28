<?php

namespace App\Jobs;

use App\Models\Kimia;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Barryvdh\DomPDF\Facade\Pdf;

class GenerateKimiaPDF implements ShouldQueue
{
    use Queueable, SerializesModels, InteractsWithQueue;

    public function handle()
    {
        $kimias = Kimia::all();

        $pdf = PDF::loadView('kimia.pdf', compact('kimias'));

        // Store the generated PDF file in a temporary location
        $tempFile = tempnam(sys_get_temp_dir(), 'kimia_pdf');
        file_put_contents($tempFile, $pdf->output());

        // Send the PDF file to the user
        return response()->download($tempFile, 'kimias.pdf', [
            'Content-Type' => 'application/pdf',
        ]);
    }
}