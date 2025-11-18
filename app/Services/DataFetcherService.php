<?php

namespace App\Services;

use App\Models\Investor;
use App\Models\Fund;
use App\Models\Investment;

class DataFetcherService
{
    protected $api;

    public function __construct(ApiService $api)
    {
        $this->api = $api;
    }

    public function fetchInvestors()
    {
        $data = $this->api->get('/api/investor');

        foreach ($data['data'] as $item) {
            Investor::updateOrCreate(
                ['id' => $item['id']],
                [
                    'name'           => $item['name'],
                    'email'          => $item['email'],
                    'contact_number' => $item['contact_number'],
                ]
            );
        }
    }

    public function fetchFunds()
    {
        $data = $this->api->get('/api/fund');

        foreach ($data['data'] as $item) {
            Fund::updateOrCreate(
                ['id' => $item['id']],
                $item
            );
        }
    }

    public function fetchInvestments()
    {
        $data = $this->api->get('/api/investments');

        foreach ($data['data'] as $item) {

            Investment::updateOrCreate(
                ['id' => $item['id']],
                [
                    'uid'            => $item['uid'],
                    'start_date'     => substr($item['start_date'], 0, 10),
                    'capital_amount' => $item['capital_amount'],
                    'status'         => $item['status'],

                    'fund_id'        => $item['fund']['id'],
                    'investor_id'    => $item['investor']['id'],
                ]
            );
        }
    }
}
