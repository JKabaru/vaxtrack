<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class DashboardController extends Controller
{
    //
    public function index()
    {
        $newUsersCount = User::whereDate('created_at', today())->count();
        $previousDayUsersCount = User::whereDate('created_at', today()->subDay())->count();

        $percentageIncrease = 0;
        if ($previousDayUsersCount > 0) {
            $percentageIncrease = (($newUsersCount - $previousDayUsersCount) / $previousDayUsersCount) * 100;
        }

        return view('admin.index', compact('newUsersCount', 'percentageIncrease'));
    }
}
