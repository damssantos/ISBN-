<?php

namespace App\Http\Controllers;

use App\Models\BukuTerbit;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class BukuTerbitController extends Controller
{
    public function index()
    {
        $bukus = BukuTerbit::orderByDesc('tanggal_terbit')->get();

        return view('user.buku-terbit', compact('bukus'));
    }

    public function show(BukuTerbit $buku)
    {
        return view('user.detail-buku', compact('buku'));
    }

    public function showLegacy(Request $request)
    {
        $buku = BukuTerbit::findOrFail($request->query('id'));

        return view('user.detail-buku', compact('buku'));
    }

    public function downloadSertifikat(BukuTerbit $buku): Response
    {
        return response($this->makeCertificatePdf($buku), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="sertifikat-isbn-'.$buku->isbn.'.pdf"',
        ]);
    }

    public function downloadCover(BukuTerbit $buku): Response
    {
        $cover = Http::timeout(15)->get($buku->cover_url);
        abort_unless($cover->successful(), 502, 'Cover buku tidak dapat diunduh.');

        return response($cover->body(), 200, [
            'Content-Type' => $cover->header('Content-Type', 'image/jpeg'),
            'Content-Disposition' => 'attachment; filename="mockup-cover-'.$buku->id.'.jpg"',
        ]);
    }

    private function makeCertificatePdf(BukuTerbit $buku): string
    {
        $commands = [
            '0.059 0.114 0.149 rg 0 0 842 595 re f',
            '0.106 0.169 0.220 rg 22 22 798 551 re f',
            '0.231 0.765 0.741 RG 3 w 35 35 772 525 re S',
            '0.361 0.851 0.831 RG 1 w 45 45 752 505 re S',
            '0.231 0.765 0.741 rg 65 490 712 52 re f',
            '0.059 0.114 0.149 rg 65 98 712 2 re f',
        ];
        $commands[] = $this->pdfText(82, 510, 22, 'YPIK PAM JAYA PRESS', 'F2', '1 1 1');
        $commands[] = $this->pdfText(82, 477, 10, 'PORTAL PENERBITAN DAN REGISTRASI ISBN', 'F1', '0.72 0.89 0.90');
        $commands[] = $this->pdfText(421, 421, 30, 'SERTIFIKAT ISBN', 'F2', '1 1 1', true);
        $commands[] = $this->pdfText(421, 394, 12, 'Nomor ISBN resmi telah diterbitkan untuk karya berikut', 'F1', '0.72 0.80 0.85', true);
        $commands[] = '0.078 0.235 0.286 rg 265 342 312 42 re f';
        $commands[] = '0.231 0.765 0.741 RG 1 w 265 342 312 42 re S';
        $commands[] = $this->pdfText(421, 356, 20, $buku->isbn, 'F2', '0.361 0.851 0.831', true);
        $commands[] = $this->pdfText(95, 300, 10, 'JUDUL BUKU', 'F2', '0.48 0.66 0.73');
        $commands[] = $this->pdfText(95, 272, 22, $buku->judul, 'F2', '1 1 1');
        $commands[] = $this->pdfText(95, 224, 10, 'PENULIS UTAMA', 'F2', '0.48 0.66 0.73');
        $commands[] = $this->pdfText(95, 202, 14, $buku->penulis, 'F1', '0.92 0.96 0.98');
        $commands[] = $this->pdfText(420, 224, 10, 'TANGGAL TERBIT', 'F2', '0.48 0.66 0.73');
        $commands[] = $this->pdfText(420, 202, 14, $buku->tanggal_terbit->locale('id')->translatedFormat('d F Y'), 'F1', '0.92 0.96 0.98');
        $commands[] = $this->pdfText(95, 156, 10, 'PENERBIT', 'F2', '0.48 0.66 0.73');
        $commands[] = $this->pdfText(95, 134, 14, $buku->penerbit, 'F1', '0.92 0.96 0.98');
        $commands[] = $this->pdfText(605, 156, 10, 'TERVERIFIKASI', 'F2', '0.48 0.66 0.73', true);
        $commands[] = '0.231 0.765 0.741 RG 2 w 548 130 114 2 re S';
        $commands[] = $this->pdfText(605, 112, 11, 'YPIK PAM JAYA', 'F2', '0.92 0.96 0.98', true);
        $commands[] = $this->pdfText(421, 67, 9, 'Dokumen resmi diterbitkan secara digital oleh YPIK PAM JAYA Press', 'F1', '0.48 0.66 0.73', true);
        $stream = implode("\n", $commands);
        $objects = [
            '<< /Type /Catalog /Pages 2 0 R >>',
            '<< /Type /Pages /Kids [3 0 R] /Count 1 >>',
            '<< /Type /Page /Parent 2 0 R /MediaBox [0 0 842 595] /Resources << /Font << /F1 5 0 R /F2 6 0 R >> >> /Contents 4 0 R >>',
            "<< /Length ".strlen($stream)." >>\nstream\n{$stream}\nendstream",
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica >>',
            '<< /Type /Font /Subtype /Type1 /BaseFont /Helvetica-Bold >>',
        ];
        $pdf = "%PDF-1.4\n";
        $offsets = [];

        foreach ($objects as $index => $object) {
            $offsets[] = strlen($pdf);
            $number = $index + 1;
            $pdf .= "{$number} 0 obj\n{$object}\nendobj\n";
        }

        $xref = strlen($pdf);
        $pdf .= "xref\n0 ".(count($objects) + 1)."\n0000000000 65535 f \n";

        foreach ($offsets as $offset) {
            $pdf .= sprintf("%010d 00000 n \n", $offset);
        }

        return $pdf."trailer\n<< /Size ".(count($objects) + 1)." /Root 1 0 R >>\nstartxref\n{$xref}\n%%EOF";
    }

    private function pdfText(int $x, int $y, int $size, string $text, string $font, string $color, bool $center = false): string
    {
        $safeText = $this->escapePdfText($text);

        if ($center) {
            $x -= (int) (strlen($text) * $size * 0.27);
        }

        return "BT {$color} rg /{$font} {$size} Tf {$x} {$y} Td ({$safeText}) Tj ET";
    }

    private function escapePdfText(string $text): string
    {
        return str_replace(['\\', '(', ')'], ['\\\\', '\\(', '\\)'], $text);
    }
}
