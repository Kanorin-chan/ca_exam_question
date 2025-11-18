<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;
use App\Models\Investor;
use App\Models\Fund;

class InvestmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Investment::with(['fund', 'investor']);

        if ($request->search) {
            $query->where('uid', 'LIKE', "%{$request->search}%")
                  ->orWhereHas('investor', function($q) use ($request) {
                      $q->where('name', 'LIKE', "%{$request->search}%");
                  })
                  ->orWhereHas('fund', function($q) use ($request) {
                      $q->where('name', 'LIKE', "%{$request->search}%");
                  });
        }

        $investments = $query->orderBy('id', 'asc')->paginate(10);

        return view('investment.index', compact('investments'));
    }
}
