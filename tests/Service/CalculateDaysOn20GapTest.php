<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/22/21
 * Time: 7:28 PM
 */

namespace App\Tests\Service;

use App\Service\CalculateDaysOn20Gap;

use PHPUnit\Framework\TestCase;

class CalculateDaysOn20GapTest extends TestCase
{
    public function testDaysByGap()
    {
        CalculateDaysOn20Gap::calculate(.20);
        CalculateDaysOn20Gap::calculate(.10);
        $days = CalculateDaysOn20Gap::calculate(.20);

        $this->assertEquals(3, $days);
    }

    public function testDaysByGap2()
    {
        CalculateDaysOn20Gap::resetValues();

        CalculateDaysOn20Gap::calculate(.20);
        CalculateDaysOn20Gap::calculate(.20);
        CalculateDaysOn20Gap::calculate(.20);
        CalculateDaysOn20Gap::calculate(.20);
        $days = CalculateDaysOn20Gap::calculate(.20);

        $this->assertEquals(5, $days);
    }

    public function testDaysByGap3()
    {
        CalculateDaysOn20Gap::resetValues();

        CalculateDaysOn20Gap::calculate(.20);
        CalculateDaysOn20Gap::calculate(.10);
        CalculateDaysOn20Gap::calculate(.10);
        CalculateDaysOn20Gap::calculate(.10);
        $days = CalculateDaysOn20Gap::calculate(.10);

        $this->assertEquals(5, $days);

        $days = CalculateDaysOn20Gap::calculate(.20);

        $this->assertEquals(1, $days);
    }

    public function testDaysByGap4()
    {
        CalculateDaysOn20Gap::resetValues();

        CalculateDaysOn20Gap::calculate(.20);
        CalculateDaysOn20Gap::calculate(.10);
        CalculateDaysOn20Gap::calculate(.10);
        CalculateDaysOn20Gap::calculate(.10);
        CalculateDaysOn20Gap::calculate(.05);
        $days = CalculateDaysOn20Gap::calculate(.20);

        $this->assertEquals(1, $days);
    }

    public function testDaysByGap5()
    {
        CalculateDaysOn20Gap::resetValues();

        CalculateDaysOn20Gap::calculate(.10);
        CalculateDaysOn20Gap::calculate(.05);
        $days = CalculateDaysOn20Gap::calculate(.10);

        $this->assertEquals(0, $days);
    }

    public function testDaysByGap6()
    {
        CalculateDaysOn20Gap::resetValues();

        CalculateDaysOn20Gap::calculate(.05);
        $days = CalculateDaysOn20Gap::calculate(.45);

        $this->assertEquals(1, $days);
    }

    public function testDaysByGap7()
    {
        CalculateDaysOn20Gap::resetValues();

        CalculateDaysOn20Gap::calculate(.20);
        CalculateDaysOn20Gap::calculate(.05);
        $days = CalculateDaysOn20Gap::calculate(.45);

        $this->assertEquals(3, $days);
    }

    public function testDaysByGap8()
    {
        CalculateDaysOn20Gap::resetValues();

        CalculateDaysOn20Gap::calculate(.20);
        CalculateDaysOn20Gap::calculate(.10);
        CalculateDaysOn20Gap::calculate(.10);
        CalculateDaysOn20Gap::calculate(.10);
        $days =CalculateDaysOn20Gap::calculate(.05);

        $this->assertEquals(5, $days);

        $days = CalculateDaysOn20Gap::calculate(.10);

        $this->assertEquals(0, $days);
    }
}

//class CalculateDaysOn20GapTest extends TestCase
//{
//    private $calc;
//
//    public function testDaysByGap()
//    {
//        $this->calc = new CalculateDaysOn20Gap();
//
//        $this->calc->calculate(.20);
//        $this->calc->calculate(.10);
//        $days = $this->calc->calculate(.20);
//
//        $this->assertEquals(3, $days);
//    }
//
//    public function testDaysByGap2()
//    {
//        $this->calc = new CalculateDaysOn20Gap();
//
//        $this->calc->calculate(.20);
//        $this->calc->calculate(.20);
//        $this->calc->calculate(.20);
//        $this->calc->calculate(.20);
//        $days = $this->calc->calculate(.20);
//
//        $this->assertEquals(5, $days);
//    }
//
//    public function testDaysByGap3()
//    {
//        $this->calc = new CalculateDaysOn20Gap();
//
//        $this->calc->calculate(.20);
//        $this->calc->calculate(.10);
//        $this->calc->calculate(.10);
//        $this->calc->calculate(.10);
//        $days = $this->calc->calculate(.10);
//
//        $this->assertEquals(5, $days);
//
//        $days = $this->calc->calculate(.20);
//
//        $this->assertEquals(1, $days);
//    }
//
//    public function testDaysByGap4()
//    {
//        $this->calc = new CalculateDaysOn20Gap();
//
//        $this->calc->calculate(.20);
//        $this->calc->calculate(.10);
//        $this->calc->calculate(.10);
//        $this->calc->calculate(.10);
//        $this->calc->calculate(.05);
//        $days = $this->calc->calculate(.20);
//
//        $this->assertEquals(1, $days);
//    }
//
//    public function testDaysByGap5()
//    {
//        $this->calc = new CalculateDaysOn20Gap();
//
//        $this->calc->calculate(.10);
//        $this->calc->calculate(.05);
//        $days = $this->calc->calculate(.10);
//
//        $this->assertEquals(0, $days);
//    }
//
//    public function testDaysByGap6()
//    {
//        $this->calc = new CalculateDaysOn20Gap();
//
//        $this->calc->calculate(.05);
//        $days = $this->calc->calculate(.45);
//
//        $this->assertEquals(1, $days);
//    }
//
//    public function testDaysByGap7()
//    {
//        $this->calc = new CalculateDaysOn20Gap();
//
//        $this->calc->calculate(.20);
//        $this->calc->calculate(.05);
//        $days = $this->calc->calculate(.45);
//
//        $this->assertEquals(3, $days);
//    }
//
//    public function testDaysByGap8()
//    {
//        $this->calc = new CalculateDaysOn20Gap();
//
//        $this->calc->calculate(.20);
//        $this->calc->calculate(.10);
//        $this->calc->calculate(.10);
//        $this->calc->calculate(.10);
//        $days =$this->calc->calculate(.05);
//
//        $this->assertEquals(5, $days);
//
//        $days = $this->calc->calculate(.10);
//
//        $this->assertEquals(0, $days);
//    }
//}

