<?php

namespace App\Filament\Widgets;

use App\Models\Scholar;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Illuminate\Support\Facades\Cache;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ScholarsOverview extends ApexChartWidget
{
    use HasWidgetShield;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'scholarsOverview';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Scholars Overview';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {

        return [
            'chart' => [
                'type' => 'pie',
                'height' => 300,
            ],
            'series' => [
                Scholar::where('status',1)->count(),
                Scholar::where('status',2)->count(),
                Scholar::where('status',3)->count(),
                Scholar::where('status',4)->count(),
            ],
            'labels' => [
                'Pending', 'Inactive', 'Active', 'Deactivated',
            ],
            'legend' => [
                'labels' => [
                    'colors' => '#9ca3af',
                    'fontWeight' => 600,
                ],
            ],
        ];
    }
}
