<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/25/21
 * Time: 11:56 AM
 */

namespace App\Tests\Service;

use App\Service\TickerOpenToHiByDayFactory;
use PHPUnit\Framework\TestCase;

class TickerOpenToHiByDayFactoryTest extends TestCase
{
    private $ticker;

    protected function setUp(): void
    {
        $this->ticker = $this->createMock(\App\Entity\Ticker::class);
    }
    /**
     * @dataProvider providerFunctionNames
     */
    public function testFunctionName($x, $j): void
    {
        $factory = new TickerOpenToHiByDayFactory($this->ticker,array(),1);
        $this->assertEquals($j, $factory->getFunctionNumber($x));
    }

    public function testCount(): void
    {
        $tickerPerformance = $this->createMock(\App\Entity\TickerPerformance::class);
        $tickerPerformance2 = $this->createMock(\App\Entity\TickerPerformance::class);
        $tickerPerformance3 = $this->createMock(\App\Entity\TickerPerformance::class);

        $tickerPerformance->expects($this->any())->method('getOtoh')->willReturn(0.60);
        $tickerPerformance2->expects($this->any())->method('getOtoh')->willReturn(0.63);
        $tickerPerformance3->expects($this->any())->method('getOtoh')->willReturn(0.63);

        $tickerPerformance->expects($this->any())->method('getDayGap')->willReturn(1);
        $tickerPerformance2->expects($this->any())->method('getDayGap')->willReturn(1);
        $tickerPerformance3->expects($this->any())->method('getDayGap')->willReturn(2);

        $factory = new TickerOpenToHiByDayFactory($this->ticker, array($tickerPerformance,$tickerPerformance2,$tickerPerformance3),1);

        $tickerOpenToHi = $factory->create();

        $this->assertEquals(2, $tickerOpenToHi->getCount60());
    }

    public function testCountAll()
    {
        $tickerPerArray = [];
        foreach ($this->providerOtoh() as [$x, $y]){
            $tickerPerformance = $this->createMock(\App\Entity\TickerPerformance::class);
            $tickerPerformance->expects($this->any())->method('getOtoh')->willReturn($x);
            $tickerPerformance->expects($this->any())->method('getDayGap')->willReturn(1);
            $tickerPerArray[] = $tickerPerformance;
        }

        $factory = new TickerOpenToHiByDayFactory($this->ticker, $tickerPerArray, 1);
        $tickerOpenToHi = $factory->create();

        $this->assertEquals(3, $tickerOpenToHi->getLessThan10());
        $this->assertEquals(3, $tickerOpenToHi->getCount10());
        $this->assertEquals(4, $tickerOpenToHi->getCount20());
        $this->assertEquals(2, $tickerOpenToHi->getCount30());
        $this->assertEquals(4, $tickerOpenToHi->getCount40());
        $this->assertEquals(1, $tickerOpenToHi->getCount50());
        $this->assertEquals(6, $tickerOpenToHi->getCount60());
        $this->assertEquals(1, $tickerOpenToHi->getCount70());
        $this->assertEquals(1, $tickerOpenToHi->getCount80());
        $this->assertEquals(3, $tickerOpenToHi->getCount90());
        $this->assertEquals(3, $tickerOpenToHi->getGreaterThan100());
    }

    public function providerFunctionNames()
    {
        return [
            [.60,60],
            [.61,60],
            [1.34,100],
            [5.6,500],
            [.20,20],
            [9.99,900],
            [.05,5],
        ];
    }

    public function providerOtoh()
    {
        return [
            [.02,2],
            [.05,5],
            [-.10,10],
            [.10,10],
            [.12,10],
            [.18,10],
            [.20,20],
            [.22,20],
            [.25,20],
            [.26,20],
            [.39,30],
            [.34,30],
            [.41,40],
            [.42,40],
            [.4543,40],
            [.4678,40],
            [.50,50],
            [.62345,60],
            [.6546,60],
            [.6234,60],
            [.6785,60],
            [.69,60],
            [.6123,60],
            [.70,70],
            [.80,80],
            [.90,90],
            [.9988,90],
            [.93,90],
            [1.90,100],
            [2.00,200],
            [5.00,500],
        ];
    }
}
