<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;

class ContactController extends Controller
{
    public function create()
    {
        return view('kontak');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'perusahaan' => 'nullable|string|max:255',
            'email' => 'required|email|max:255',
            'alamat' => 'required|string',
            'telepon' => 'nullable|string|max:20',
            'kota' => 'nullable|string|max:255',
            'negara' => 'required|string|max:255',
            'pesan' => 'required|string',
            'g-recaptcha-response' => 'required|string',
        ], [
            'g-recaptcha-response.required' => 'Verifikasi reCAPTCHA wajib dicentang.',
        ]);

        $response = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY', ''),
            'response' => $request->input('g-recaptcha-response'),
            'remoteip' => $request->ip()
        ]);

        if (!$response->json('success')) {
            return back()->withErrors(['captcha' => 'Verifikasi reCAPTCHA Google gagal/expired. Silakan coba lagi.'])->withInput();
        }

        $contact = Contact::create($validated);

        try {
            Mail::to('fizaltempat@gmail.com')->send(new ContactMessageMail($contact));
        } catch (\Exception $e) {
            // Jika ada error dari sisi SMTP email, kita log saja tapi tidak membuat web menjadi error
            // Pengguna tetap dapat melihat bahwa laporannya "Sukses Tersimpan di DB"
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email keluhan: ' . $e->getMessage());
        }

        return back()->with('success', 'Pesan log atau keluhan berhasil dikirim. Terima kasih telah menghubungi Faizal Motor 139!');
    }
}
