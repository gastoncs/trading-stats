<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/5/21
 * Time: 4:38 PM
 */

use App\Service\TickerPerformanceFactory;

use PHPUnit\Framework\TestCase;

class TickerPerformanceFactoryTest extends TestCase
{
    private $ticker;
    private $sector;
    private $industry;

    protected function setUp(): void
    {
        $this->ticker = $this->createMock(\App\Entity\Ticker::class);
        $this->sector = $this->createMock(\App\Entity\Sector::class);
        $this->industry = $this->createMock(\App\Entity\Industry::class);

    }

    public function testEndOfTheDay(): void
    {

        foreach ($this->endOfTheDayProvider() as [$dateTime, $open, $hi, $low, $close,
                                                 $volume, $atr, $float, $shortFloat, $insidersOwn, $institutionOwn,
                                                 $dilution, $marketCap, $news, $etb, $ssr, $floatRotation, $expected]) {

            $tickerPerformance = TickerPerformanceFactory::create(
                                                    $this->ticker, $dateTime, $open,
                                                    $hi, $low, $close,
                                                    $volume, $atr, $float,
                                                    $shortFloat, $insidersOwn, $institutionOwn,
                                                    $dilution, $marketCap, $news,
                                                    $etb, $ssr, $floatRotation,
                                                    $this->sector, $this->industry);

            $this->assertSame($expected, $tickerPerformance->getEod());
        }

    }

    public function testOpenToHiAndLow(): void
    {

        foreach ($this->openToHiAndLowProvider() as [$dateTime, $open, $hi, $low, $close,
                                                     $volume, $atr, $float, $shortFloat, $insidersOwn, $institutionOwn,
                                                     $dilution, $marketCap, $news, $etb, $ssr, $floatRotation, $expected]){

                $tickerPerformance = TickerPerformanceFactory::create(
                                                        $this->ticker,$dateTime,$open,
                                                        $hi,$low,$close,
                                                        $volume,$atr,$float,
                                                        $shortFloat,$insidersOwn,$institutionOwn,
                                                        $dilution,$marketCap,$news,
                                                        $etb,$ssr,$floatRotation,
                                                        $this->sector, $this->industry);

                $this->assertSame($expected, $tickerPerformance->getOtoh());
        }

    }

    public function testRange(): void
    {

        foreach ($this->rangeProvider() as [$dateTime, $open, $hi, $low, $close,
                                             $volume, $atr, $float, $shortFloat, $insidersOwn, $institutionOwn,
                                             $dilution, $marketCap, $news, $etb, $ssr, $floatRotation, $expected]){


                $tickerPerformance = TickerPerformanceFactory::create(
                                                        $this->ticker,$dateTime,$open,
                                                        $hi,$low,$close,
                                                        $volume,$atr,$float,
                                                        $shortFloat,$insidersOwn,$institutionOwn,
                                                        $dilution,$marketCap,$news,
                                                        $etb,$ssr,$floatRotation,
                                                        $this->sector, $this->industry);

                $this->assertSame($expected, $tickerPerformance->getRangeInPrice());
        }
    }

    public function testGap(): void
    {
        $this->ticker->expects($this->any())->method('getCode')->willReturn("gap");

        foreach ($this->gapProvider() as [$dateTime, $open, $hi, $low, $close,
                                            $volume, $atr, $float, $shortFloat, $insidersOwn, $institutionOwn,
                                            $dilution, $marketCap, $news, $etb, $ssr, $floatRotation, $expected]){

                $tickerPerformance = TickerPerformanceFactory::create(
                                                        $this->ticker,$dateTime,$open,
                                                        $hi,$low,$close,
                                                        $volume,$atr,$float,
                                                        $shortFloat,$insidersOwn,$institutionOwn,
                                                        $dilution,$marketCap,$news,
                                                        $etb,$ssr,$floatRotation,
                                                        $this->sector, $this->industry);

                $this->assertSame($expected, $tickerPerformance->getGap());
        }
    }

    public function endOfTheDayProvider()
    {
        return [
            [new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,3.00,-0.1528],
            [new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,5.00,-0.2124],
            [new \DateTime('+3 day'), 4.15, 4.29, 3.53, 3.92, 19175869, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00, -0.0554],
        ];
    }

    public function openToHiAndLowProvider()
    {
        return [
            [new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,3.00,0.0262],
            [new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,5.00,0.0984],
            [new \DateTime('+3 day'), 4.15, 4.29, 3.53, 3.92, 19175869, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00, 0.0337],
        ];
    }

    public function rangeProvider()
    {
        return [
            [new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,3.00,1.90],
            [new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,5.00,3.80],
            [new \DateTime('+3 day'), 4.15, 4.29, 3.53, 3.92, 19175869, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00, 0.76],
        ];
    }

    public function gapProvider()
    {
        return [
            [new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,3.00,0.00],
            [new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,5.00,0.2988],
            [new \DateTime('+3 day'), 4.15, 4.29, 3.53, 3.92, 19175869, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00,-0.4539],
        ];
    }
}
