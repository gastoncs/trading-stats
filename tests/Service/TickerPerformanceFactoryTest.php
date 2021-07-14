<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/5/21
 * Time: 4:38 PM
 */

use App\Service\TicketPerformanceFactory;

use PHPUnit\Framework\TestCase;

class TickerPerformanceFactoryTest extends TestCase
{
    private $ticketPerformanceFactory;

    protected function setUp(): void
    {
        $this->ticketPerformanceFactory = new TicketPerformanceFactory();
        $this->loadTickerPerformanceData();
    }

//    /**
//     * @dataProvider endOfTheDayProvider
//     */
//    public function testEndOfTheDay($open, $close, $expected): void
//    {
//
//        $this->tickerPerformance->setOpen($open);
//        $this->tickerPerformance->setClose($close);
//
//        $test = $this->tickerPerformance->getEod();
//
//        $this->assertSame($expected, $test);
//    }

    /**
     * @dataProvider tickerPerformanceProvider
     */
    private function loadTickerPerformanceData($ticker, $dateTime, $open, $hi, $low, $close,
                                               $volume, $atr, $float, $shortFloat, $insidersOwn, $institutionOwn,
                                               $dilution, $marketCap, $news, $etb, $ssr, $floatRotation, $sector, $industry)
    {

        $tickerPerformance = $this->ticketPerformanceFactory::create(
                                                        $ticker,$dateTime,$open,
                                                        $hi,$low,$close,
                                                        $volume,$atr,$float,
                                                        $shortFloat,$insidersOwn,$institutionOwn,
                                                        $dilution,$marketCap,$news,
                                                        $etb,$ssr,$floatRotation,
                                                        $sector,$industry);


        print_r($tickerPerformance->getGap());
    }

//    /**
//     * @dataProvider openToHiAndLowProvider
//     */
//    public function testOpenToHiAndLow($open, $hi, $expected): void
//    {
//
//        $this->tickerPerformance->setOpen($open);
//        $this->tickerPerformance->setHi($hi);
//
//        $test = $this->tickerPerformance->getOtoh();
//
//        $this->assertSame($expected, $test);
//    }
//
//    /**
//     * @dataProvider rangeProvider
//     */
//    public function testRange($hi, $low, $expected): void
//    {
//
//        $this->tickerPerformance->setHi($hi);
//        $this->tickerPerformance->setLow($low);
//
//        $test = $this->tickerPerformance->getRange();
//
//        $this->assertSame($expected, $test);
//    }

    public function endOfTheDayProvider()
    {
        return [
            [8.77, 7.43, -0.1528],
            [9.65, 7.60, -0.2124],
            [4.15, 3.92, -0.0554],
            [0.00, 0.00, 0.00]
        ];
    }

    public function openToHiAndLowProvider()
    {
        return [
            [8.77, 9.00, 0.0262],
            [9.65, 10.60, 0.0984],
            [4.15, 4.29, 0.0337],
            [0.00, 0.00, 0.00]
        ];
    }

    public function rangeProvider()
    {
        return [
            [9.00, 7.10, 1.90],
            [10.60, 6.80, 3.80],
            [4.29, 3.53, 0.76],
            [1.00, .00, 0.00]
        ];
    }

    private function tickerPerformanceProvider(): array
    {
        return [
            ['XELA', new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,3.00],
            ['XELA', new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,5.00],
            ['XELA', new \DateTime('+3 day'), 4.15, 4.29, 3.53, 3.92, 19175869, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00],
        ];
    }
}
