<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AccountWidgetCustom extends Widget
{
    protected static ?int $sort = -3;

    public function getColumnSpan(): int|string|array
    {
        return 'full';
    }

    protected static string $view = 'filament-panels::widgets.account-widget';
}
