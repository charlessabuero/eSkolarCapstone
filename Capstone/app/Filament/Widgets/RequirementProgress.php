<?php

namespace App\Filament\Widgets;

use App\Models\Requirement;
use App\Models\RequirementUser;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class RequirementProgress extends ApexChartWidget
{
    use HasWidgetShield;
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'requirementProgress';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'Requirement Progress';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $requirements = Requirement::getAllRequirementsScholar(auth()->user()->id)->count();
        $requirements_approved = RequirementUser::where('user_id',auth()->id())->where('is_approved',true)->count();
        return [
            'chart' => [
                'type' => 'radialBar',
                'height' => 300,
            ],
            'series' => [(($requirements_approved==0)? 0 : (($requirements/$requirements_approved)*100))],
            'plotOptions' => [
                'radialBar' => [
                    'hollow' => [
                        'size' => '70%',
                    ],
                    'dataLabels' => [
                        'show' => true,
                        'name' => [
                            'show' => true,
                            'color' => '#9ca3af',
                            'fontWeight' => 600,
                        ],
                        'value' => [
                            'show' => true,
                            'color' => '#9ca3af',
                            'fontWeight' => 600,
                            'fontSize' => '20px',
                        ],
                    ],

                ],
            ],
            'stroke' => [
                'lineCap' => 'round',
            ],
            'labels' => ['RequirementProgress'],
            'colors' => ['#6366f1'],
        ];
    }
}
