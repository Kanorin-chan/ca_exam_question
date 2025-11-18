<?php

namespace App\Http\Controllers;

class GraphController extends Controller
{
    public function index()
    {
        $file = public_path("sample_data.csv");

        $dates = [];
        $values = [];
        $pnls = [];
        $cumulative = 0;

        if (($handle = fopen($file, "r")) !== false) {

            $first = true;

            while (($row = fgetcsv($handle, 1000, ",")) !== false) {

                if ($first) {
                    $first = false;
                    continue; // skip header line
                }

                $date = $row[0];
                $pnl  = floatval($row[1]);

                // save PnL for metrics
                $pnls[] = $pnl;

                // cumulative
                $cumulative += $pnl;

                $dates[] = $date;
                $values[] = $cumulative;
            }

            fclose($handle);
        }

        // ---- Metrics ---- //

        $meanPnl = array_sum($pnls) / count($pnls);

        $annualReturn = $meanPnl * 365;

        $std = $this->stdDeviation($pnls);

        $sharpe = $std > 0 ? ($meanPnl / $std) * sqrt(365) : 0;

        $maxDrawdown = $this->calculateMaxDrawdown($values);

        $calmar = $maxDrawdown == 0 ? 0 : $annualReturn / abs($maxDrawdown);

        return view('graph.index', compact(
            'dates',
            'values',
            'annualReturn',
            'sharpe',
            'maxDrawdown',
            'calmar'
        ));
    }

    private function stdDeviation($array)
    {
        $n = count($array);
        if ($n === 0) return 0;

        $mean = array_sum($array) / $n;

        $variance = 0;
        foreach ($array as $value) {
            $variance += pow($value - $mean, 2);
        }

        return sqrt($variance / $n);
    }

    private function calculateMaxDrawdown($equity)
    {
        $peak = $equity[0];
        $maxDD = 0;

        foreach ($equity as $value) {
            if ($value > $peak) {
                $peak = $value;
            }

            $dd = $value - $peak;
            if ($dd < $maxDD) {
                $maxDD = $dd;
            }
        }

        return $maxDD;
    }

}
