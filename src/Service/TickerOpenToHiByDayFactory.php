<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/16/21
 * Time: 3:02 PM
 */

namespace App\Service;

use App\Entity\TickerOpenToHi;
use App\Entity\TickerPerformance;
use App\Entity\Ticker;

class TickerOpenToHiGapByDayFactory
{
    private $tickerPerformances;
    private $ticker;
    private $day;

    public function __construct(Ticker $ticker,array $tickerPerformances, $day)
    {
        $this->tickerPerformances = $tickerPerformances;
        $this->day = $day;
        $this->ticker = $ticker;
    }

    public function create()
    {
        $tickerOpenToHi = new TickerOpenToHi();

        $tickerOpenToHi->setTicker($this->ticker);

        foreach ($this->tickerPerformances as $tickerPerformance)
        {
            if($tickerPerformance instanceof TickerPerformance){

                if( $this->day == $tickerPerformance->getDayGap()){

                    $number = $this->getFunctionNumber($tickerPerformance->getOtoh());

                    if($number < 10){
                        $tickerOpenToHi->setLessThan10();
                    }
                    if($number >= 10 and $number < 100){
                        $tickerOpenToHi->{"setCount".$number}();
                    }
                    if($number >= 100){
                        $tickerOpenToHi->setGreaterThan100();
                    }
                }
            }
        }

        return $tickerOpenToHi;
    }

    public function getFunctionNumber($otoh)
    {
        $var = 0;
        if(log10($otoh)>=0){
            $var = 1;
        }elseif(log10($otoh)>=-1){
            $var = 0.1;
        }else{
            $var = 0.01;
        }

        $mod1 = fmod($otoh,$var * 10);

        $result = ($mod1 - fmod($otoh, $var)) * 100;

        if(strpos(strrev($mod1), ".") == 1 && floor($mod1) == 0){
            $result =  $mod1 * 100;
        }

        return $result;
    }
}