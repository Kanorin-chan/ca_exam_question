<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\DataFetcherService;

class FetchAssessmentData extends Command
{
    protected $signature = 'assessment:fetch';
    protected $description = 'Fetch investors, funds, and investments data';

    public function handle(DataFetcherService $fetcher)
    {
        $this->info('Fetching investors...');
        $fetcher->fetchInvestors();

        $this->info('Fetching funds...');
        $fetcher->fetchFunds();

        $this->info('Fetching investments...');
        $fetcher->fetchInvestments();

        $this->info('All data fetched successfully!');
    }
}
