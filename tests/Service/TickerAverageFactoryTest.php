<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/7/21
 * Time: 6:31 PM
 */

use App\Service\TickerAverageFactory;
use App\Service\TickerAverageCalculator\TickerAverageCalculatorByDay;
use Doctrine\Persistence\ObjectManager;

use PHPUnit\Framework\TestCase;

class TickerFactoryTest extends TestCase
{

    /**
     * @dataProvider tickerPerformanceProvider
     */
    public function testAvgVoume(\App\Entity\Ticker $ticker, $dateTime, $open, $hi, $low, $close, $volume): void
    {

        \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);

        $tickerPerformanceRepository = $this->createMock(\App\Repository\TickerPerformanceRepository::class);

        $tickerPerformanceRepository->expects($this->any())
                                    ->method('findByDay')
                                    ->willReturn(array());

        $objectManager = $this->createMock(ObjectManager::class);
        $objectManager->expects($this->any())
                      ->method('getRepository')
                      ->willReturn($tickerPerformanceRepository);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($objectManager);

        TickerAverageFactory::create($ticker, $tickerAverageCalculator,1);
    }

//    private $tickerPerformance;
//    private $tickerPerformance2;
//    private $tickerPerformance3;
//    private $tickerPerformance4;
//    private $tickerPerformance5;
//    private $tickerPerformance6;
//
//    protected function setUp(): void
//    {
//        $this->tickerPerformance = $this->createMock(\App\Entity\TickerPerformance::class);
//        $this->tickerPerformance2 = $this->createMock(\App\Entity\TickerPerformance::class);
//        $this->tickerPerformance3 = $this->createMock(\App\Entity\TickerPerformance::class);
//        $this->tickerPerformance4 = $this->createMock(\App\Entity\TickerPerformance::class);
//        $this->tickerPerformance5 = $this->createMock(\App\Entity\TickerPerformance::class);
//        $this->tickerPerformance6 = $this->createMock(\App\Entity\TickerPerformance::class);
//    }
//
//    public function testAvgVoume(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getVolume')->willReturn(2000);
//        $this->tickerPerformance2->expects($this->any())->method('getVolume')->willReturn(1000);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.30);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.20);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array( $this->tickerPerformance,$this->tickerPerformance2 )));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2 );
//
//
//        $this->assertEquals(1500, $ticker->getAvgVolume());
//    }
//
//    public function testAvgVoume_2(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getVolume')->willReturn(2000);
//        $this->tickerPerformance2->expects($this->any())->method('getVolume')->willReturn(1000);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.10);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.20);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//
//        $this->assertEquals(1000, $ticker->getAvgVolume());
//    }
//
//    public function testAvgVoume_3(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getVolume')->willReturn(2000);
//        $this->tickerPerformance2->expects($this->any())->method('getVolume')->willReturn(1000);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.10);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.05);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance, $this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//        $this->assertEquals(0, $ticker->getAvgVolume());
//    }
//
//    public function testAvgGap(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(100.00);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(200.00);
//        $this->tickerPerformance3->expects($this->any())->method('getGap')->willReturn(200.50);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2,$this->tickerPerformance3)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//        $ticker->addTickerPerformance($this->tickerPerformance3);
//
//        $this->assertEquals(166.8333, $ticker->getAvgGap());
//    }
//
//    public function testAvgEOD(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getEod')->willReturn(100.00);
//        $this->tickerPerformance2->expects($this->any())->method('getEod')->willReturn(200.00);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.25);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//                        new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//        $this->assertEquals(150.00, $ticker->getAvgEod());
//    }
//
//    public function testAvgOToH(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getOtoh')->willReturn(100.00);
//        $this->tickerPerformance2->expects($this->any())->method('getOtoh')->willReturn(200.00);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.25);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//        $this->assertEquals(150.00, $ticker->getAvgOtoh());
//    }
//
//    public function testAvgOToH2(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getOtoh')->willReturn(100.00);
//        $this->tickerPerformance2->expects($this->any())->method('getOtoh')->willReturn(200.00);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.19);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//        $this->assertEquals(100.00, $ticker->getAvgOtoh());
//    }
//
//    public function testAvgOToHGreater0(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getOtoh')->willReturn(100.00);
//        $this->tickerPerformance2->expects($this->any())->method('getOtoh')->willReturn(200.00);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.21);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//        $this->assertEquals(150.00, $ticker->getAvgOtohGreater0());
//
//
//        //Test 2
//
//        $tickerPerformance = $this->createMock(\App\Entity\TickerPerformance::class);
//        $tickerPerformance2 = $this->createMock(\App\Entity\TickerPerformance::class);
//
//        $tickerPerformance->expects($this->any())->method('getOtoh')->willReturn(-1.50);
//        $tickerPerformance2->expects($this->any())->method('getOtoh')->willReturn(200.00);
//
//        $tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.21);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($tickerPerformance,$tickerPerformance2)));
//
//        $ticker->addTickerPerformance($tickerPerformance);
//        $ticker->addTickerPerformance($tickerPerformance2);
//
//        $this->assertEquals(200.00, $ticker->getAvgOtohGreater0());
//    }
//
//    public function testAvgOToL(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getOtol')->willReturn(100.00);
//        $this->tickerPerformance2->expects($this->any())->method('getOtol')->willReturn(200.00);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.21);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//        $this->assertEquals(150.00, $ticker->getAvgOtol());
//    }
//
//    public function testAvgOToLLess0(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getOtol')->willReturn(-1.00);
//        $this->tickerPerformance2->expects($this->any())->method('getOtol')->willReturn(-2.00);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.21);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//        $this->assertEquals(-1.50, $ticker->getAvgOtolLower0());
//
//        //Test 2
//
//        $tickerPerformance = $this->createMock(\App\Entity\TickerPerformance::class);
//        $tickerPerformance2 = $this->createMock(\App\Entity\TickerPerformance::class);
//
//        $tickerPerformance->expects($this->any())->method('getOtol')->willReturn(-2.50);
//        $tickerPerformance2->expects($this->any())->method('getOtol')->willReturn(200.00);
//
//        $tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.21);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($tickerPerformance,$tickerPerformance2)));
//
//        $ticker->addTickerPerformance($tickerPerformance);
//        $ticker->addTickerPerformance($tickerPerformance2);
//
//        $this->assertEquals(-2.50, $ticker->getAvgOtolLower0());
//    }
//
//    public function testAvgRange(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getRangeInPrice')->willReturn(100.00);
//        $this->tickerPerformance2->expects($this->any())->method('getRangeInPrice')->willReturn(200.00);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.21);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//        $this->assertEquals(150.00, $ticker->getAvgRange());
//    }
//
//    public function testAvgRange2(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getRangeInPrice')->willReturn(100.00);
//        $this->tickerPerformance2->expects($this->any())->method('getRangeInPrice')->willReturn(200.00);
//
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.18);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,$this->tickerPerformance2)));
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//
//        $this->assertEquals(100.00, $ticker->getAvgRange());
//    }
//
//    public function testEODMuestraGreater0(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance3->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance4->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance5->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance6->expects($this->any())->method('getGap')->willReturn(0.20);
//
//        $this->tickerPerformance->expects($this->any())->method('getEod')->willReturn(.43);
//        $this->tickerPerformance2->expects($this->any())->method('getEod')->willReturn(.50);
//        $this->tickerPerformance3->expects($this->any())->method('getEod')->willReturn(3.22);
//        $this->tickerPerformance4->expects($this->any())->method('getEod')->willReturn(3.22);
//        $this->tickerPerformance5->expects($this->any())->method('getEod')->willReturn(3.22);
//        $this->tickerPerformance6->expects($this->any())->method('getEod')->willReturn(-1.2);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,
//                $this->tickerPerformance2,
//                $this->tickerPerformance3,
//                $this->tickerPerformance4,
//                $this->tickerPerformance5,
//                $this->tickerPerformance6)
//            )
//        );
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//        $ticker->addTickerPerformance($this->tickerPerformance3);
//        $ticker->addTickerPerformance($this->tickerPerformance4);
//        $ticker->addTickerPerformance($this->tickerPerformance5);
//        $ticker->addTickerPerformance($this->tickerPerformance6);
//
//        $this->assertEquals(.83, $ticker->getEodMuestraGreater0());
//        $this->assertEquals(.17, $ticker->getEodMuestraLess0());
//    }
//
//    public function testEODMuestraGreater0_1(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.10);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance3->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance4->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance5->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance6->expects($this->any())->method('getGap')->willReturn(0.20);
//
//        $this->tickerPerformance->expects($this->any())->method('getEod')->willReturn(.43);
//        $this->tickerPerformance2->expects($this->any())->method('getEod')->willReturn(.50);
//        $this->tickerPerformance3->expects($this->any())->method('getEod')->willReturn(3.22);
//        $this->tickerPerformance4->expects($this->any())->method('getEod')->willReturn(3.22);
//        $this->tickerPerformance5->expects($this->any())->method('getEod')->willReturn(-2.22);
//        $this->tickerPerformance6->expects($this->any())->method('getEod')->willReturn(-1.2);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,
//                    $this->tickerPerformance2,
//                    $this->tickerPerformance3,
//                    $this->tickerPerformance4,
//                    $this->tickerPerformance5,
//                    $this->tickerPerformance6)
//            )
//        );
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//        $ticker->addTickerPerformance($this->tickerPerformance3);
//        $ticker->addTickerPerformance($this->tickerPerformance4);
//        $ticker->addTickerPerformance($this->tickerPerformance5);
//        $ticker->addTickerPerformance($this->tickerPerformance6);
//
//        $this->assertEquals(.60, $ticker->getEodMuestraGreater0());
//        $this->assertEquals(.40, $ticker->getEodMuestraLess0());
//    }
//
//
//    public function testEODMuestraGreater0_2(): void
//    {
//        $this->tickerPerformance->expects($this->any())->method('getGap')->willReturn(0.10);
//        $this->tickerPerformance2->expects($this->any())->method('getGap')->willReturn(0.10);
//        $this->tickerPerformance3->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance4->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance5->expects($this->any())->method('getGap')->willReturn(0.20);
//        $this->tickerPerformance6->expects($this->any())->method('getGap')->willReturn(0.20);
//
//        $this->tickerPerformance->expects($this->any())->method('getEod')->willReturn(.43);
//        $this->tickerPerformance2->expects($this->any())->method('getEod')->willReturn(.50);
//        $this->tickerPerformance3->expects($this->any())->method('getEod')->willReturn(3.22);
//        $this->tickerPerformance4->expects($this->any())->method('getEod')->willReturn(3.22);
//        $this->tickerPerformance5->expects($this->any())->method('getEod')->willReturn(-2.22);
//        $this->tickerPerformance6->expects($this->any())->method('getEod')->willReturn(-1.2);
//
//        $ticker = TickerAverageFactory::create("ANPC","Summary is great",
//            new TickerAverageCalculator20Gap(array($this->tickerPerformance,
//                    $this->tickerPerformance2,
//                    $this->tickerPerformance3,
//                    $this->tickerPerformance4,
//                    $this->tickerPerformance5,
//                    $this->tickerPerformance6)
//            )
//        );
//
//        $ticker->addTickerPerformance($this->tickerPerformance);
//        $ticker->addTickerPerformance($this->tickerPerformance2);
//        $ticker->addTickerPerformance($this->tickerPerformance3);
//        $ticker->addTickerPerformance($this->tickerPerformance4);
//        $ticker->addTickerPerformance($this->tickerPerformance5);
//        $ticker->addTickerPerformance($this->tickerPerformance6);
//
//        $this->assertEquals(.50, $ticker->getEodMuestraGreater0());
//        $this->assertEquals(.50, $ticker->getEodMuestraLess0());
//    }

    public function tickerPerformanceProvider()
    {
        return [
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800],
//            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800],
//            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+3 day'), 4.15, 4.29, 3.53, 3.92, 19175869, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800],
        ];
    }
}
