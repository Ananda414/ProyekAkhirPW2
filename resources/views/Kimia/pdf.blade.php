<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kimia</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 30px;
        }
        .header img {
            max-height: 80px;
            margin-right: 20px;
        }
        .header .text-container {
            display: flex;
            flex-direction: column;
        }
        .header .text-container .school-name,
        .header .text-container .foundation-name,
        .header .text-container .address {
            font-size: 16px; /* Adjusted to maintain consistency */
        }
        .header .text-container .foundation-name {
            font-size: 24px; /* Larger font size for the foundation name */
            font-weight: bold;
        }
        .header .text-container .school-name {
            font-size: 24px; /* Slightly smaller than foundation name */
            font-weight: bold;
            margin-top: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 5px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .footer {
            position: relative;
            bottom: 0;
            width: 100%;
            text-align: right;
            padding: 20px;
            font-size: 12px;
            page-break-inside: avoid;
            margin-top: 5px;
        }
        .footer .sign {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-top: 50px;
        }
        .footer .sign .date {
            font-size: 14px;
            margin-bottom: 20px;
        }
        .footer .sign .responsibility {
            font-size: 14px;
            margin-bottom: 80px;
        }
        .footer .sign .name {
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/images/logo sekolah.jpg') }}" alt="School Logo">
        <div class="text-container">
            <div class="foundation-name">Yayasan Pembina Palembang</div>
            <div class="school-name">Sekolah Menengah Kejuruan (SMK) Farmasi</div>
            <div class="address">Alamat: Jl. Jendral Bambang Utoyo No. 179 Telp. (0711) 710349 Palembang</div>
        </div>
    </div>
    <h2>Daftar Kimia</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Volume</th>
                <th>Jumlah</th>
                <th>Kondisi Baik</th>
                <th>Kondisi Tidak Baik</th>
                <th>Terpakai</th>
                <th>Sisa</th>
                <th>Terakhir Dipakai</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kimias as $item)
            <tr>
                <td>{{ $item->nama }}</td>
                <td>{{ $item->volume }}</td>
                <td>{{ $item->jumlah }}</td>
                <td>{{ $item->kondisi_baik }}</td>
                <td>{{ intval($item->jumlah) - intval($item->kondisi_baik) }}</td>
                <td>{{ $item->terpakai }}</td>
                <td>{{ intval($item->jumlah) - intval($item->terpakai) }}</td>
                <td>{{ $item->terakhir_dipakai ? \Carbon\Carbon::parse($item->terakhir_dipakai)->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') : '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <div class="sign">
            <div class="date">
                Dicetak pada: {{ \Carbon\Carbon::now()->setTimezone('Asia/Jakarta')->format('d-m-Y H:i:s') }}
            </div>
            <div class="responsibility">
                Yang bertanggung jawab di bawah ini:
            </div>
            <div class="name">
            </div>
            <div class="name">
                Olivia Rachmi, S.Pd
            </div>
        </div>
    </div>
</body>
</html>
