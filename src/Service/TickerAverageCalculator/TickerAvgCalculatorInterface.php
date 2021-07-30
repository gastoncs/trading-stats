<?php

/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/15/21
 * Time: 6:05 PM
 */
interface TickerAvgCalculatorInterface
{
    public static function calculate(array $tickerPerformances);
    public function getAvgOtolLower0();
    public function getAvgOtohGreater0();
    public function getAvgVolume();
    public function getAvgGap();
    public function getAvgEDO();
    public function getAvgOtoh();
    public function getAvgOtol();
    public function getAvgRange();
}