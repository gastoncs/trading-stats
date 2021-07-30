<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/24/21
 * Time: 9:18 AM
 */

namespace App\Service\TickerAverageCalculator;


use App\Entity\Ticker;
use App\Repository\TickerPerformanceRepository;

class TickerAverageCalculatorByDay implements TickerAvgCalculatorByDayInterface
{
    const EODGreaterThan0 = 0;

    private $tickerPerformanceRepository;
    private $avgOtolLower0;
    private $avgOtohGreater0;
    private $avgVolume;
    private $avgGap;
    private $avgEDO;
    private $avgOtoh;
    private $avgOtol;
    private $avgRange;
    private $eodGreater0;
    private $eodLess0;
    private $eodCount;
    private $dayGap;

    public function __construct(TickerPerformanceRepository $tickerPerformanceRepository)
    {
        $this->tickerPerformanceRepository = $tickerPerformanceRepository;
        $this->avgOtolLower0 = $this->avgOtohGreater0 = $this->avgVolume = 0;
        $this->eodGreater0 = $this->avgGap = $this->avgEDO = $this->avgOtoh = 0;
        $this->eodCount = $this->eodLess0 = $this->avgOtol = $this->avgRange = 0;
    }

    public function calculate(Ticker $ticker, int $day):TickerAverageCalculatorByDay
    {
        $this->dayGap = $day;

        $tickerPerformances = $this->tickerPerformanceRepository->findByDay($ticker, $day);

        $this->createAvgVolume($tickerPerformances);
        $this->createAvgGap($tickerPerformances);
        $this->createAvgEod($tickerPerformances);
        $this->createAvgOtoh($tickerPerformances);
        $this->createAvgOtohGreater0($tickerPerformances);
        $this->createAvgOtol($tickerPerformances);
        $this->createAvgOtolLower0($tickerPerformances);
        $this->createAvgRange($tickerPerformances);
        $this->createEODGreater0($tickerPerformances);

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
     * @return float
     */
    public function getEodGreater0(): float
    {
        return $this->eodGreater0;
    }

    /**
     * @return float
     */
    public function getEodLess0(): float
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

    /**
     * @return mixed
     */
    public function getDayGap()
    {
        return $this->dayGap;
    }

    private function createAvgVolume($tickerPerformances)
    {
        $value = $voulme = $count = 0.00;
        foreach($tickerPerformances as $i => $item) {
            $voulme += $item->getVolume();
            $count++;
        }

        if($voulme <> 0){
            $value = round($voulme / $count, 2);
        }

        return $this->avgVolume = $value;
    }

    private function createAvgGap($tickerPerformances):float
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

    private function createAvgEod($tickerPerformances): float
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

    private function createAvgOtoh($tickerPerformances): float
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

    private function createAvgOtohGreater0($tickerPerformances): float
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

    private function createAvgOtol($tickerPerformances): float
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

    private function createAvgOtolLower0($tickerPerformances): float
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

    private function createAvgRange($tickerPerformances): float
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

    /**
     * @return float
     */
    private function createEODGreater0($tickerPerformances): float
    {
        $eodCount = $eodNegCount = $count = 0;
        foreach($tickerPerformances as $i => $item) {

                if($item->getEod() > self::EODGreaterThan0){
                    $eodCount++;
                }else{
                    $eodNegCount++;
                }
                $count++;
        }

        if($count > 0){

            $this->eodGreater0 = round($eodCount / $count,2);
            $this->eodLess0 = round($eodNegCount / $count,2);
            $this->eodCount = $count;
        }

        return $this->eodGreater0;
    }
}