<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class OrderExport implements FromView, ShouldAutoSize
{
    protected $data;
    protected $year;
    protected $month;

    public function __construct($data, $year, $month)
    {
       $this->data = $data;
       $this->year = $year;
       $this->month = $month;

    }
    public function view(): View
    {
        return view('admin.export.orderExport', [
            'orders' => $this->data,
            'year' => $this->year,
            'month' => $this->month
        ]);
    }
}
