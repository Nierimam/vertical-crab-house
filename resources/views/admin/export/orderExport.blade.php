<table>
    <tr>
        <th></th>
        <th></th>
        <th></th>
        @php
        $bulans = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
        ]
    @endphp
    @php
        $currentMonth = ($month ?? 'all') == 'all' ? 15 : $month;
        $currentYear = ($year ?? 'all') == 'all' ? 15 : $year;
    @endphp
        @if (isset($year) || isset($month))
            <th colspan="7" style="font-size: 17px; text-align: center;"><b>Data Pesanan {{ $currentMonth == 15 ? '' : 'Bulan ' . $bulans[$currentMonth - 1]}} {{ $currentYear == 15 ? '' : 'Tahun ' . $currentYear }}</b></th>
        @else
            <th colspan="7" style="font-size: 17px; text-align: center;"><b>Data Pesanan</b></th>
        @endif
    </tr>
</table>

<table>
    <thead style="border: 1px solid black;">
        <tr style="border: 1px solid black;">
            <th></th>
            <th></th>
            <th></th>
            <th style="border: 1px solid black;"><b>No</b></th>
            <th style="border: 1px solid black;"><b>Invoice</b></th>
            <th style="border: 1px solid black;"><b>No Resi</b></th>
            <th style="border: 1px solid black;"><b>Nama Customer</b></th>
            <th style="border: 1px solid black;"><b>Alamat</b></th>
            <th style="border: 1px solid black;"><b>Total</b></th>
            <th style="border: 1px solid black;"><b>Status</b></th>
        </tr>
    </thead>
    @php
        $index = 0
    @endphp
    @foreach ($orders as $order)
        <tbody style="border: 1px solid black;">
            <tr style="border: 1px solid black;">
                <td></td>
                <td></td>
                <td></td>
                <td style="border: 1px solid black;">{{ ++$index }}</td>
                <td style="border: 1px solid black;">{{ $order->invoice }}</td>
                <td style="border: 1px solid black;">{{ $order->no_resi }}</td>
                <td style="border: 1px solid black;">{{ $order->customers->nama_lengkap }}</td>
                <td style="border: 1px solid black;">{{ $order->alamat }}</td>
                <td style="border: 1px solid black;">Rp {{ number_format($order->total,0,',','.') }}</td>
                <td style="border: 1px solid black;">{{ $order->status }}</td>
            </tr>
        </tbody>
    @endforeach
        <tbody style="border: 1px solid black;">
            <tr style="border: 1px solid black;">
                <th></th>
                <th></th>
                <th></th>
                <th style="border: 1px solid black; text-align:center;" colspan="5">Total Pesanan Keseluruhan</th>
                <th style="border: 1px solid black; text-align:center;" colspan="2">Rp {{ number_format($orders->sum('total'),0,',','.') }}</th>
            </tr>
        </tbody>
</table>  
<br><br><br>
