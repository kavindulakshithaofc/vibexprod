<?php

namespace App\Filament\Resources\MembersResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MembersOverview extends BaseWidget
{
    protected function getStats(): array
    {
		$totalMembers = \App\Models\Members::count();
		$inactiveMembers = \App\Models\Members::where('membership_status', 'inactive')->count();
        return [
			Stat::make('Total Members', $totalMembers),
			Stat::make('Inactive Members', $inactiveMembers),
        ];
    }
}
