<?php

namespace App\Http\Controllers;

use App\Models\Fund;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function index(Request $request)
    {
        $query = Fund::query();

        if ($request->search) {
            $query->where('name', 'LIKE', "%{$request->search}%");
        }

        $funds = $query->orderBy('id')->paginate(10);

        return view('fund.index', compact('funds'));
    }

    public function create()
    {
        return view('fund.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        Fund::create([
            'name' => $request->name,
        ]);

        return redirect()->route('funds.index');
    }

    public function edit(Fund $fund)
    {
        return view('fund.edit', compact('fund'));
    }

    public function update(Request $request, Fund $fund)
    {
        $request->validate([
            'name' => 'required|string',
        ]);

        $fund->update([
            'name' => $request->name,
        ]);

        return redirect()->route('funds.index');
    }

}
