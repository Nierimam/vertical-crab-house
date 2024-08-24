<?php
if (!function_exists('statusInfo')) {
    function statusInfo(){
        $data = [
            'status_agro' => [
                true || 1 => [
                    "label" => "Aktif",
                    "color" => "success",
                    "text" => "Sudah Di Setujui Admin dan Sudah Aktif"
                ],
                false || 0 => [
                    "label" => "Tidak Aktif",
                    "color" => "warning",
                    "text" => "Harap Tunggu Persetujuan Admin Agar Aktif"
                ]
            ],
            'status_tampil_produk' => [
                "publish" => [
                    "label" => "Publish",
                    "color" => "success"
                ],
                "non_publish" => [
                    "label" => "Tidak Publish",
                    "color" => "warning"
                ]
            ]
            ,
            'status_order' => [
                "pending" => [
                    "label" => "Pending",
                    "color" => "warning",
                    "text" => "Pesanan Pending Harap Menunggu Konfirmasi Admin"
                ],
                "menunggu_pembayaran" => [
                    "label" => "Menunggu Pembayaran",
                    "color" => "warning",
                    "text" => "Harap Melakukan Pembayaran Terlebih Dahulu"
                ],
                "terbayar" => [
                    "label" => "Terbayar",
                    "color" => "success",
                    "text" => "Pesanan Sudah Terbayar"
                ],
                "pengiriman" => [
                    "label" => "Pengiriman",
                    "color" => "info",
                    "text" => "Pesanan Sedang Dalam Perjalanan"
                ],
                "diterima" => [
                    "label" => "Diterima",
                    "color" => "success",
                    "text" => "Pesanan Telah Diterima"
                ],
                "dibatalkan" => [
                    "label" => "Dibatalkan",
                    "color" => "danger",
                    "text" => "Pesanan Telah Dibatalkan"
                ],
                "ditolak" => [
                    "label" => "Ditolak",
                    "color" => "danger",
                    "text" => "Pesanan Telah Ditolak"
                ]

            ]
        ];

        return $data;
    }
}

?>


