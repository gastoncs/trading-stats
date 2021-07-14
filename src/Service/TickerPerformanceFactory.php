<?php

/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/3/21
 * Time: 2:25 PM
 */

namespace App\Service;

use App\Entity\TickerPerformance;

class TicketPerformanceFactory
{
    private static $data;

    public static function create($ticker, $dateTime, $open, $hi, $low, $close, $volume, $atr, $float, $shortFloat,
                                                   $insidersOwn, $institutionOwn, $dilution, $marketCap, $news, $etb, $ssr, $floatRotation,
                                                   $sector, $industry): TickerPerformance
    {
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
        $tp->setSector($sector);
        $tp->setIndustry($industry);

        return $tp;
    }

    private function createGap($open, $close)
    {
        //$dateFormatUnix = strtotime($date);

        $lastClose = self::$data[0];

        $gap = 0;
        if($lastClose != ""){
            $gap = ($open / $lastClose) -1;
            self::$data[0] = $close;
        }

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