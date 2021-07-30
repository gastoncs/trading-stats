<?php

/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/15/21
 * Time: 6:03 PM
 */
class TickerAverageCalculator20Gap implements TickerAvgCalculatorInterface
{
    private $avgOtolLower0;
    private $avgOtohGreater0;
    private $avgVolume;
    private $avgGap;
    private $avgEDO;
    private $avgOtoh;
    private $avgOtol;
    private $avgRange;

    public static function calculate(array $tickerPerformances): TickerAverageOn20Gap
    {
        if(count($tickerPerformances) > 0){
            (new self)->createAvgVolume($tickerPerformances);
            (new self)->createAvgGap($tickerPerformances);
            (new self)->createAvgEod($tickerPerformances);
            (new self)->createAvgOtoh($tickerPerformances);
            (new self)->createAvgOtohGreater0($tickerPerformances);
            (new self)->createAvgOtol($tickerPerformances);
            (new self)->createAvgOtolLower0($tickerPerformances);
            (new self)->createAvgRange($tickerPerformances);
        }

        return self::;
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

    private function createAvgVolume(array $tickerPerformances):float
    {
        $value = $voulme = $count = 0;
        foreach($tickerPerformances as $i => $item) {
            $voulme += $item->getVolume();
            $count++;
        }

        if($voulme <> 0){
            $value = round($voulme / $count, 2);
        }

        return $this->avgVolume = $value;
    }

    private function createAvgGap(array $tickerPerformances):float
    {
        $value = $gapper = $count = 0;
        foreach($tickerPerformances as $i => $item) {
            $gapper += $item->getGap();
            $count++;
        }

        if($gapper <> 0){
            $value =  round($gapper / $count, 4);
        }

        return $this->avgGap = $value;
    }

    private function createAvgEod(array $tickerPerformances): float
    {
        $value = $eod = $count = 0;
        foreach($tickerPerformances as $i => $item) {
            $eod += $item->getEod();
            $count++;
        }


        if($eod <> 0){
            $value = round($eod / $count,4);
        }

        return $this->avgEDO = $value;
    }

    private function createAvgOtoh(array $tickerPerformances): float
    {
        $value = $otoh = $count = 0;
        foreach($tickerPerformances as $i => $item) {
            $otoh += $item->getOtoh();
            $count++;
        }

        if($otoh <> 0){
            $value = round($otoh / $count,4);
        }
        return $this->avgOtoh = $value;
    }

    private function createAvgOtohGreater0(array $tickerPerformances): float
    {
        $value = $otoh = $count = 0;
        foreach($tickerPerformances as $i => $item) {

            if($item->getOtoh() > 0){
                $otoh += $item->getOtoh();
                $count++;
            }
        }

        if($otoh <> 0){
            $value = round($otoh / $count,4);
        }
        return $this->avgOtohGreater0 = $value;
    }

    private function createAvgOtol(array $tickerPerformances): float
    {
        $value = $otol = $count = 0;
        foreach($tickerPerformances as $i => $item) {
            $otol += $item->getOtol();
            $count++;
        }

        if($otol <> 0){
            $value = round($otol / $count,4);
        }

        return $this->avgOtol = $value;
    }

    private function createAvgOtolLower0(array $tickerPerformances): float
    {
        $value = $otol = $count = 0;
        foreach($tickerPerformances as $i => $item) {

            if($item->getOtol() < 0){
                $otol += $item->getOtol();
                $count++;
            }
        }

        if($otol <> 0){
            $value = round($otol / $count,4);
        }

        return $this->avgOtolLower0 = $value;
    }

    private function createAvgRange(array $tickerPerformances): float
    {
        $value = $range = $count = 0;
        foreach($tickerPerformances as $i => $item) {
            $range += $item->getRangeInPrice();
            $count++;
        }

        if($range <> 0){
            $value = round($range / $count,2);
        }

        return $this->avgRange = $value;
    }
}