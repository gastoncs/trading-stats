<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/22/21
 * Time: 5:40 PM
 */

namespace App\Service;


//class CalculateDaysOn20Gap
//{
//    const GAP = 0.20;
//    const DAYS = 5;
//
//    private $day;
//    private $flag;
//
//    public function calculate(float $gap)
//    {
//        $return = 0;
//
//        if($gap >= self::GAP){
//            $this->flag = 1;
//        }
//
//        if($this->flag){
//            $return = ++$this->day;
//        }
//
//        if($this->day == self::DAYS){
//            $this->day = $this->flag = 0;
//        }
//
//        return $return;
//    }
//}

class CalculateDaysOn20Gap
{
    public static $day;
    public static $flag;

    const GAP = 0.20;
    const DAYS = 5;

    public static function calculate(float $gap)
    {
        $return = 0;

        if ($gap >= self::GAP) {
            self::$flag = 1;
        }

        if (self::$flag) {
            $return = ++self::$day;
        }

        if (self::$day == 5) {
            self::$day = self::$flag = 0;
        }

        return $return;
    }

    public static function resetValues()
    {
        self::$day = self::$flag = 0;
    }
}