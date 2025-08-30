<?php

namespace App\Charts;

use Carbon\Carbon;
use App\Models\Visitor;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class VisitorCountChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\lineChart
    {
        $bulan = date('m');
        for($i = 1; $i <= $bulan; $i++){
            $datavisitor = visitor::whereMonth('visited_at', $i)->count();
            $databulan[] = Carbon::create()->month($i)->format('F');
            $datatotalvisitor[] = $datavisitor;
        }

        return $this->chart->lineChart()
            ->setTitle('Grafik Pengunjung Web Repository')
            ->setSubtitle(date('Y'))
            ->addData('Pengunjung', $datatotalvisitor)
            ->setXAxis($databulan);

    }
}
