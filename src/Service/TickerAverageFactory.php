<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/5/21
 * Time: 10:49 PM
 */

namespace App\Service;

use App\Entity\Ticker;

use App\Entity\TickerAverage;
use App\Service\TickerAverageCalculator\TickerAvgCalculatorInterface;

class TickerFactory
{
    public static function create(Ticker $ticker, TickerAvgCalculatorInterface $tickerAvgCalculator): Ticker
    {
        $tickerAvg = new TickerAverage();

        $tickerAvgCalculatorObj = $tickerAvgCalculator->calculate();

        $tickerAvg->setTicker($ticker);

        $tickerAvg->setAvgVolume($tickerAvgCalculatorObj->getAvgVolume());
        $tickerAvg->setAvgGap($tickerAvgCalculatorObj->getAvgGap());
        $tickerAvg->setAvgEod($tickerAvgCalculatorObj->getAvgEDO());
        $tickerAvg->setAvgOtoh($tickerAvgCalculatorObj->getAvgOtoh());
        $tickerAvg->setAvgOtohGreater0($tickerAvgCalculatorObj->getAvgOtohGreater0());
        $tickerAvg->setAvgOtol($tickerAvgCalculatorObj->getAvgOtol());
        $tickerAvg->setAvgOtolLower0($tickerAvgCalculatorObj->getAvgOtolLower0());
        $tickerAvg->setAvgRange($tickerAvgCalculatorObj->getAvgRange());
        $tickerAvg->setEodGreater0($tickerAvgCalculatorObj->getEodGreater0());
        $tickerAvg->setEodLess0($tickerAvgCalculatorObj->getEodLess0());
        $tickerAvg->setEodCount($tickerAvgCalculatorObj->getEodCount());

        return $ticker;
    }

    public static function updateAverages(TickerAverage $tickerAvg, TickerAvgCalculatorInterface $tickerAvgCalculator): Ticker
    {
        $tickerAvgCalculatorObj = $tickerAvgCalculator->calculate();

        $tickerAvg->setAvgVolume($tickerAvgCalculatorObj->getAvgVolume());
        $tickerAvg->setAvgGap($tickerAvgCalculatorObj->getAvgGap());
        $tickerAvg->setAvgEod($tickerAvgCalculatorObj->getAvgEDO());
        $tickerAvg->setAvgOtoh($tickerAvgCalculatorObj->getAvgOtoh());
        $tickerAvg->setAvgOtohGreater0($tickerAvgCalculatorObj->getAvgOtohGreater0());
        $tickerAvg->setAvgOtol($tickerAvgCalculatorObj->getAvgOtol());
        $tickerAvg->setAvgOtolLower0($tickerAvgCalculatorObj->getAvgOtolLower0());
        $tickerAvg->setAvgRange($tickerAvgCalculatorObj->getAvgRange());
        $tickerAvg->setEodGreater0($tickerAvgCalculatorObj->getEodMuestraGreater0());
        $tickerAvg->setEodLess0($tickerAvgCalculatorObj->getEodLess0());
        $tickerAvg->setEodCount($tickerAvgCalculatorObj->getEodMuestra());

        return $tickerAvg;
    }

}