<?php

/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/3/21
 * Time: 2:25 PM
 */

namespace App\Service;

use App\Entity\Industry;
use App\Entity\Sector;
use App\Entity\Ticker;
use App\Entity\TickerPerformance;

class TickerPerformanceFactory
{
    public static $data;
    public static $tickerName;

    public static function create(Ticker $ticker, $dateTime, $open, $hi, $low, $close, $volume, $atr=0.00, $float=0.00, $shortFloat=0.00,
                                       $insidersOwn=0.00, $institutionOwn=0.00, $dilution=0.00, $marketCap=0.00, $news=null,
                                        $etb=0,$ssr=0, $floatRotation=0,$sector=null, $industry=null): TickerPerformance
    {
        //Reset the static variable when a new ticket
        if(self::$tickerName != $ticker->getCode()){
            self::$data = NULL;
            CalculateDaysOn20Gap::resetValues();
        }

        self::$tickerName = $ticker->getCode();

        $eod = (new self)->createEOD($open, $close);
        $gap = (new self)->createGap($open, $close);
        $otoh = (new self)->createOtoh($hi, $open);
        $otol = (new self)->createOthol($low, $open);
        $range = (new self)->createRangeInPrice($hi, $low);

        $tp = new TickerPerformance();

        $tp->setTicker($ticker);
        $tp->setDate($dateTime);
        $tp->setOpen($open);
        $tp->setHi($hi);
        $tp->setLow($low);
        $tp->setClose($close);
        $tp->setVolume($volume);
        $tp->setGap($gap);
        $tp->setEod($eod);
        $tp->setOtoh($otoh);
        $tp->setOtol($otol);
        $tp->setRangeInPrice($range);
        $tp->setAtr($atr);
        $tp->setShareFloat($float);
        $tp->setShortFloat($shortFloat);
        $tp->setInsidersOwn($insidersOwn);
        $tp->setInstitutionOwn($institutionOwn);
        $tp->setDilution($dilution);
        $tp->setMarketCap($marketCap);
        $tp->setNews($news);
        $tp->setEtb($etb);
        $tp->setSsr($ssr);
        $tp->setFloatRotation($floatRotation);

        $tp->setDayGap(CalculateDaysOn20Gap::calculate($gap));

        if($sector instanceof Sector){
            $tp->setSector($sector);
        }
        if($industry instanceof Industry){
            $tp->setIndustry($industry);
        }

        return $tp;
    }

    private function createGap($open, $close)
    {
        $lastClose = self::$data;

        $gap = 0;
        if($lastClose != ""){
            $gap = round(($open / $lastClose) -1, 4);
        }

        self::$data = $close;

        return $gap;
    }

    private function createEOD($open, $close)
    {
        if(($close && $open)!=0){
            return round(($close / $open) -1 , 4);
        }
    }

    private function createOtoh($hi,$open)
    {
        if(($hi && $open)!= 0){
            return round(($hi / $open) -1 , 4);
        }
    }

    private function createOthol($low, $open)
    {
        if(($low && $open)!=0){
            return round(($low / $open) -1 , 4);
        }
    }

    private function createRangeInPrice($hi, $low)
    {
        if(($hi && $low)!=0){
             return round(($hi - $low), 2);
        }
    }
}