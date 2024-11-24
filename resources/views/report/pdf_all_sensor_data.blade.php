<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Monitoring</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h5 class="">Laporan Data Sensor</h5>
    <p>Data Tanggal : <span>{{ date('d/m/Y', strtotime($from_date)) }}</span> - <span>{{ date('d/m/Y', strtotime($to_date)) }}</span></p>
  
    <table class="table table-bordered mt-3">
        <tr>
            <th>Tegangan </th>
            <th>Arus</th>
            <th>Daya</th>
            <!-- <th>Daya Reaktif</th>
            <th>Daya Semu</th>
            <th>Frekuensi</th> -->
            <th>Energi</th>
            <th>Biaya</th>
            <th>Waktu</th>
        </tr>
        @foreach($datas as $data)
        <tr>
            <td>{{ $data->tegangan }} V</td>
            <td>{{ $data->arus }} A</td>
            <td>{{ $data->dy_aktif }} W</td>
            <!-- <td>{{ $data->dy_reaktif }}</td>
            <td>{{ $data->dy_semu }}</td>
            <td>{{ $data->frekuensi }}</td> -->
            <td>{{ $data->energi }} kWh</td>
            <td>Rp. {{ $data->biaya }}</td>
            <td>{{ $data->created_at->translatedFormat('d/m/Y H:i') }}</td>
        </tr>
        @endforeach
    </table>
  
</body>
</html>
