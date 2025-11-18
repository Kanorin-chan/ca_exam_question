<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;
use App\Models\Investor;

class InvestorController extends Controller
{
    protected $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    public function index(Request $request)
    {
        $query = Investor::query();

        if ($request->search) {
            $query->where('name', 'LIKE', "%{$request->search}%")
                ->orWhere('email', 'LIKE', "%{$request->search}%")
                ->orWhere('contact_number', 'LIKE', "%{$request->search}%");
        }

        $investors = $query->orderBy('id', 'asc')->paginate(10);

        return view('investors.index', compact('investors'));
    }

    public function create()
    {
        return view('investors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'           => 'required|string',
            'email'          => 'required|email',
            'contact_number' => 'required|string',
        ]);

        // Send to external API
        $response = $this->api->post('/api/investor', $validated);

        // Save locally
        $inv = $response['data'];

        Investor::updateOrCreate(
            ['id' => $inv['id']],
            [
                'name'           => $inv['name'],
                'email'          => $inv['email'],
                'contact_number' => $inv['contact_number'],
            ]
        );

        return redirect()->route('investors.index')->with('success', 'Investor created successfully!');
    }

    public function edit($id)
    {
        $investor = Investor::findOrFail($id);
        return view('investors.edit', compact('investor'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name'           => 'required|string',
            'email'          => 'required|email',
            'contact_number' => 'required|string',
        ]);

        // Update via external API
        $response = $this->api->put("/api/investor/{$id}", $validated);

        // Update local DB
        $inv = $response['data'];

        Investor::updateOrCreate(
            ['id' => $inv['id']],
            [
                'name'           => $inv['name'],
                'email'          => $inv['email'],
                'contact_number' => $inv['contact_number'],
            ]
        );

        return redirect()->route('investors.index')->with('success', 'Investor updated successfully!');
    }
}
