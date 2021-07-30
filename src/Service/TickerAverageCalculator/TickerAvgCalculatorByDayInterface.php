<?php

namespace App\Service\TickerAverageCalculator;
use App\Entity\Ticker;

/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/15/21
 * Time: 6:05 PM
 */
interface TickerAvgCalculatorByDayInterface
{
    public function calculate(Ticker $ticker, int $day);
    public function getAvgOtolLower0();
    public function getAvgOtohGreater0();
    public function getAvgVolume();
    public function getAvgGap();
    public function getAvgEDO();
    public function getAvgOtoh();
    public function getAvgOtol();
    public function getAvgRange();
    public function getEodGreater0();
    public function getEodLess0();
    public function getEodCount();
    public function getDayGap();
}