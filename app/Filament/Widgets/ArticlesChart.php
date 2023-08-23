<?php

namespace App\Filament\Widgets;

use App\Models\Article;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class ArticlesChart extends ApexChartWidget
{
    /**
     * Chart Id
     *
     * @var string
     */
    protected static string $chartId = 'articlesChart';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $heading = 'ArticlesChart';

    /**
     * @return array
     */
    protected function getFormSchema(): array
    {
        return [

            Select::make('period')
                ->default('monthly')
                ->options([
                    'monthly'=>'monthly',
                    'daily'=>'daily'
                ]),

        ];
    }

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getOptions(): array
    {
        $period = $this->filterFormData['period'];
        if($period == 'monthly'){
            $startDate = now()->startOfYear();
            $endDate = now()->endOfYear();
        }else{
            $startDate = now()->startOfMonth();
            $endDate = now()->endOfMonth();
        }
        $data = Trend::model(Article::class)
            ->between(
                start: $startDate,
                end: $endDate,
            )
            ->perMonth(false)
            ->perDay()
            ->count();
        return [
            'chart' => [
                'type' => 'line',
                'height' => 300,
            ],
            'series' => [
                [
                    'name' => 'ArticlesChart',
                    'data' => $data->map(fn(TrendValue $value) => $value->aggregate),
                ],
            ],
            'xaxis' => [
                'categories' => $data->map(fn(TrendValue $value) => $value->date),
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
            'stroke' => [
                'curve' => 'smooth',
            ],
        ];
    }
}
