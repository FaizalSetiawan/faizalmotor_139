<!DOCTYPE html>
<html>
<head>
    <title>Sistem Pengaduan - Faizal Motor 139</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f9fc; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background: #0284c7; color: #ffffff; padding: 20px; text-align: center; }
        .header h2 { margin: 0; font-size: 24px; }
        .content { padding: 30px; color: #333333; line-height: 1.6; }
        .data-table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        .data-table th, .data-table td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #e2e8f0; }
        .data-table th { width: 35%; color: #64748b; font-weight: 600; background-color: #f8fafc; }
        .message-box { background: #f8fafc; padding: 20px; border-radius: 8px; border-left: 4px solid #38bdf8; margin-top: 10px; }
        .footer { text-align: center; padding: 20px; font-size: 13px; color: #94a3b8; background: #f1f5f9; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pesan Kotak Masuk Baru</h2>
        </div>
        <div class="content">
            <p>Halo Admin, ada seseorang yang mengisi form pengaduan/kontak terbaru dari website Faizal Motor 139.</p>
            
            <table class="data-table">
                <tr>
                    <th>Nama</th>
                    <td>{{ $contact->nama }}</td>
                </tr>
                <tr>
                    <th>Perusahaan</th>
                    <td>{{ $contact->perusahaan ?: '-' }}</td>
                </tr>
                <tr>
                    <th>Email Pengirim</th>
                    <td>{{ $contact->email }}</td>
                </tr>
                <tr>
                    <th>Telepon/WA</th>
                    <td>{{ $contact->telepon ?: '-' }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>{{ $contact->alamat }}</td>
                </tr>
                <tr>
                    <th>Kota</th>
                    <td>{{ $contact->kota ?: '-' }}</td>
                </tr>
                <tr>
                    <th>Negara</th>
                    <td>{{ $contact->negara }}</td>
                </tr>
            </table>

            <p style="font-weight: bold; margin-bottom: 5px;">Pesan / Keluhan:</p>
            <div class="message-box">
                {!! nl2br(e($contact->pesan)) !!}
            </div>
        </div>
        <div class="footer">
            Sistem Notifikasi Faizal Motor 139 &copy; {{ date('Y') }}
        </div>
    </div>
</body>
</html>
