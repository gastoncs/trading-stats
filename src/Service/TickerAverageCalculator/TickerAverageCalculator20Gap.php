<?php

namespace App\Service\TickerAverageCalculator;

/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/15/21
 * Time: 6:03 PM
 */
class TickerAverageCalculator20Gap implements TickerAvgCalculatorInterface
{
    const GAP = 0.20;
    const EODGreaterThan0 = 0;

    private $avgOtolLower0;
    private $avgOtohGreater0;
    private $avgVolume;
    private $avgGap;
    private $avgEDO;
    private $avgOtoh;
    private $avgOtol;
    private $avgRange;
    private $tickerPerformances;
    private $eodGreater0;
    private $eodLess0;
    private $eodCount;
    private $dayGap;

    public function __construct(array $tickerPerformances)
    {
        $this->tickerPerformances = $tickerPerformances;
        $this->avgOtolLower0 = $this->avgOtohGreater0 = $this->avgVolume = 0;
        $this->eodGreater0 = $this->avgGap = $this->avgEDO = $this->avgOtoh = 0;
        $this->eodCount = $this->eodLess0 = $this->avgOtol = $this->avgRange = 0;
        $this->dayGap = 0;
    }

    public function calculate(): TickerAverageCalculator20Gap
    {
        if(count($this->tickerPerformances) > 0){
            $this->createAvgVolume();
            $this->createAvgGap();
            $this->createAvgEod();
            $this->createAvgOtoh();
            $this->createAvgOtohGreater0();
            $this->createAvgOtol();
            $this->createAvgOtolLower0();
            $this->createAvgRange();
            $this->eodGreater0();
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getAvgOtolLower0()
    {
        return $this->avgOtolLower0;
    }

    /**
     * @return mixed
     */
    public function getAvgOtohGreater0()
    {
        return $this->avgOtohGreater0;
    }

    /**
     * @return mixed
     */
    public function getAvgVolume()
    {
        return $this->avgVolume;
    }

    /**
     * @return mixed
     */
    public function getAvgGap()
    {
        return $this->avgGap;
    }

    /**
     * @return mixed
     */
    public function getAvgEDO()
    {
        return $this->avgEDO;
    }

    /**
     * @return mixed
     */
    public function getAvgOtoh()
    {
        return $this->avgOtoh;
    }

    /**
     * @return mixed
     */
    public function getAvgOtol()
    {
        return $this->avgOtol;
    }

    /**
     * @return mixed
     */
    public function getAvgRange()
    {
        return $this->avgRange;
    }

    /**
     * @return int
     */
    public function getEodGreater0(): int
    {
        return $this->eodGreater0;
    }

    /**
     * @return mixed
     */
    public function getEodLess0()
    {
        return $this->eodLess0;
    }

    /**
     * @return int
     */
    public function getEodCount(): int
    {
        return $this->eodCount;
    }

    private function createAvgVolume()
    {
        $value = $voulme = $count = 0.00;
        foreach($this->tickerPerformances as $i => $item) {
            if($item->getGap() >= self::GAP ){
                $voulme += $item->getVolume();
                $count++;
            }
        }

        if($voulme <> 0){
            $value = round($voulme / $count, 2);
        }

        return $this->avgVolume = $value;
    }

    private function createAvgGap():float
    {
        $value = $gapper = $count = 0;
        foreach($this->tickerPerformances as $i => $item) {
            if($item->getGap() >= self::GAP ){
                $gapper += $item->getGap();
                $count++;
            }
        }

        if($gapper <> 0){
            $value =  round($gapper / $count, 4);
        }

        return $this->avgGap = $value;
    }

    private function createAvgEod(): float
    {
        $value = $eod = $count = 0;
        foreach($this->tickerPerformances as $i => $item) {
            if($item->getGap() >= self::GAP ){
                $eod += $item->getEod();
                $count++;
            }
        }

        if($eod <> 0){
            $value = round($eod / $count,4);
        }

        return $this->avgEDO = $value;
    }

    private function createAvgOtoh(): float
    {
        $value = $otoh = $count = 0;
        foreach($this->tickerPerformances as $i => $item) {
            if($item->getGap() >= self::GAP ){
                $otoh += $item->getOtoh();
                $count++;
            }
        }

        if($otoh <> 0){
            $value = round($otoh / $count,4);
        }
        return $this->avgOtoh = $value;
    }

    private function createAvgOtohGreater0(): float
    {
        $value = $otoh = $count = 0;
        foreach($this->tickerPerformances as $i => $item) {

            if($item->getOtoh() > 0){
                if($item->getGap() >= self::GAP ){
                    $otoh += $item->getOtoh();
                    $count++;
                }
            }
        }

        if($otoh <> 0){
            $value = round($otoh / $count,4);
        }
        return $this->avgOtohGreater0 = $value;
    }

    private function createAvgOtol(): float
    {
        $value = $otol = $count = 0;
        foreach($this->tickerPerformances as $i => $item) {
            if($item->getGap() >= self::GAP ){
                $otol += $item->getOtol();
                $count++;
            }
        }

        if($otol <> 0){
            $value = round($otol / $count,4);
        }

        return $this->avgOtol = $value;
    }

    private function createAvgOtolLower0(): float
    {
        $value = $otol = $count = 0;
        foreach($this->tickerPerformances as $i => $item) {

            if($item->getOtol() < 0){
                if($item->getGap() >= self::GAP ) {
                    $otol += $item->getOtol();
                    $count++;
                }
            }
        }

        if($otol <> 0){
            $value = round($otol / $count,4);
        }

        return $this->avgOtolLower0 = $value;
    }

    private function createAvgRange(): float
    {
        $value = $range = $count = 0;
        foreach($this->tickerPerformances as $i => $item) {
            if($item->getGap() >= self::GAP ) {
                $range += $item->getRangeInPrice();
                $count++;
            }
        }

        if($range <> 0){
            $value = round($range / $count,2);
        }

        return $this->avgRange = $value;
    }

    /**
     * @return float
     */
    private function eodGreater0(): float
    {
        $eodCount = $eodNegCount = $count = 0;
        foreach($this->tickerPerformances as $i => $item) {

            if($item->getGap() >= self::GAP ) {
                if($item->getEod() > self::EODGreaterThan0){
                    $eodCount++;
                }else{
                    $eodNegCount++;
                }
                $count++;
            }
        }

        if($count > 0){
            $this->eodGreater0 = round($eodCount / $count,2);
            $this->eodLess0 = round($eodNegCount / $count,2);
            $this->eodCount = $count;
        }

        return $this->eodGreater0;
    }
}