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
use App\Service\TickerAverageCalculator\TickerAvgCalculatorByDayInterface;

class TickerAverageFactory
{
    public static function create(Ticker $ticker,
                                  TickerAvgCalculatorByDayInterface $tickerAvgCalculator,
                                  int $day): TickerAverage
    {
        $tickerAvg = new TickerAverage();

        $tickerAvgCalculatorObj = $tickerAvgCalculator->calculate($ticker, $day);

        $tickerAvg->setTicker($ticker);
        $tickerAvg->setUpdated(new \DateTime());

        $tickerAvg->setDayGap($tickerAvgCalculatorObj->getDayGap());
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

        return $tickerAvg;
    }

    public static function updateAverages(TickerAverage $tickerAvg,
                                          TickerAvgCalculatorByDayInterface $tickerAvgCalculator,
                                          int $day): TickerAverage
    {
        $tickerAvgCalculatorObj = $tickerAvgCalculator->calculate($tickerAvg->getTicker(), $day);

        $tickerAvg->setDayGap($tickerAvgCalculatorObj->getDayGap());
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

        return $tickerAvg;
    }

}