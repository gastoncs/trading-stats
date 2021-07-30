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

class TickerAverageFactoryTest extends TestCase
{
    private $tickerPerformanceRepository;
    private $ticker;

    protected function setUp(): void
    {
        $this->tickerPerformanceRepository = $this->createMock(\App\Repository\TickerPerformanceRepository::class);
        $this->ticker = $this->createMock(\App\Entity\Ticker::class);
    }

    public function testAvgVoume(): void
    {
        $tpArr = [];
        foreach ($this->getTickerPerformanceProvider() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
            ->method('findByDay')
            ->with($this->ticker, 1)
            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        $this->assertEquals(11619178, $tickerFactory->getAvgVolume());
    }

    public function testAvgGap(): void
    {
        $tickerPerformance = $this->getMockBuilder(\App\Entity\TickerPerformance::class)->getMock();
        $tickerPerformance2 = $this->getMockBuilder(\App\Entity\TickerPerformance::class)->getMock();
        $tickerPerformance3 = $this->getMockBuilder(\App\Entity\TickerPerformance::class)->getMock();
        $tickerPerformance->method('getGap')->willReturn(100.00);
        $tickerPerformance2->method('getGap')->willReturn(200.00);
        $tickerPerformance3->method('getGap')->willReturn(200.00);

        $ticker = $this->createMock(\App\Entity\Ticker::class);

        $this->tickerPerformanceRepository->expects($this->once())
                                            ->method('findByDay')
                                            ->with($ticker, 1)
                                            ->willReturn(array($tickerPerformance,$tickerPerformance2,$tickerPerformance3));

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($ticker, $tickerAverageCalculator,1);

        $this->assertEquals(166.6667, $tickerFactory->getAvgGap());
    }

    public function testAvgEOD(): void
    {
        $tpArr = [];
        foreach ($this->getTickerPerformanceProvider() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
            ->method('findByDay')
            ->with($this->ticker, 1)
            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        /*(7.43 / 8.77) -1
        (7.60 / 9.65) -1
        (3.92 / 4.15) -1*/

        $this->assertEquals(-0.1402, $tickerFactory->getAvgEod());
    }

    public function testAvgOToH(): void
    {
        $tpArr = [];
        foreach ($this->getTickerPerformanceProvider() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
            ->method('findByDay')
            ->with($this->ticker, 1)
            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        /*(9 / 8.77) -1
        (10.6 / 9.65) -1
        (4.29 / 4.15) -1*/

        $this->assertEquals(0.0528, $tickerFactory->getAvgOtoh());
    }

    public function testAvgOToHGreater0(): void
    {
        $tpArr = [];
        foreach ($this->getAvgOToHGreater0Provider() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
                                            ->method('findByDay')
                                            ->with($this->ticker, 1)
                                            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        /*(9 / 8.77) -1
            (10.6 / 9.65) -1
            (3 / 4.15) -1*/

        $this->assertEquals(0.0623, $tickerFactory->getAvgOtohGreater0());
    }

    public function testAvgOToL(): void
    {
        $tpArr = [];
        foreach ($this->getTickerPerformanceProvider() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
                                            ->method('findByDay')
                                            ->with($this->ticker, 1)
                                            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        /*(7.10 / 8.77) -1
        (6.80 / 9.65) -1
        (3.53 / 4.15) -1*/

        $this->assertEquals(-0.2117, $tickerFactory->getAvgOtol());
    }

    public function testAvgOToLLess0(): void
    {
        $tpArr = [];
        foreach ($this->getAvgOToLLess0Provider() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
                                            ->method('findByDay')
                                            ->with($this->ticker, 1)
                                            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        /*(7.10 / 8.77) -1
        (6.80 / 9.65) -1
        (5 / 4.15) -1*/

        $this->assertEquals(-0.2429, $tickerFactory->getAvgOtolLower0());
    }

    public function testAvgRange(): void
    {
        $tpArr = [];
        foreach ($this->getTickerPerformanceProvider() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
                                            ->method('findByDay')
                                            ->with($this->ticker, 1)
                                            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        /*9 - 7.10
        10.6 - 6.80
        4.29 - 3.53*/

        $this->assertEquals(2.15, $tickerFactory->getAvgRange());
    }
    public function testEODGreater0(): void
    {
        $tpArr = [];
        foreach ($this->getEODProvider() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
                                            ->method('findByDay')
                                            ->with($this->ticker, 1)
                                            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        /*
         * (7.43 / 8.77) - 1
         * (7.60 / 9.65) - 1
         * (3.92 / 4.15) - 1
         */

        $this->assertEquals(0, $tickerFactory->getEodGreater0());
        $this->assertEquals(1, $tickerFactory->getEodLess0());
    }

    public function testEODGreater0_1(): void
    {
        $tpArr = [];
        foreach ($this->getEODProvider_1() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
                                            ->method('findByDay')
                                            ->with($this->ticker, 1)
                                            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        /*
         * (7.43 / 8.77) - 1
         * (7.60 / 9.65) - 1
         * (8 / 4.15) - 1
         */

        $this->assertEquals(0.33, $tickerFactory->getEodGreater0());
        $this->assertEquals(0.67, $tickerFactory->getEodLess0());
    }

    public function testEODGreater0_2(): void
    {
        $tpArr = [];
        foreach ($this->getEODProvider_2() as [$ticker, $dateTime, $open, $hi, $low, $close, $volume]) {
            $tpArr[] = \App\Service\TickerPerformanceFactory::create($ticker, $dateTime, $open, $hi, $low, $close, $volume);
        }

        $this->tickerPerformanceRepository->expects($this->once())
                                            ->method('findByDay')
                                            ->with($this->ticker, 1)
                                            ->willReturn($tpArr);

        $tickerAverageCalculator = new TickerAverageCalculatorByDay($this->tickerPerformanceRepository);

        $tickerFactory = TickerAverageFactory::create($this->ticker, $tickerAverageCalculator, 1);

        /*
         * (10 / 8.77) - 1
         * (11 / 9.65) - 1
         * (3.92 / 4.15) - 1
         */

        $this->assertEquals(0.67, $tickerFactory->getEodGreater0());
        $this->assertEquals(0.33, $tickerFactory->getEodLess0());
    }

    public function getTickerPerformanceProvider()
    {
        return [
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+3 day'), 4.15, 4.29, 3.53, 3.92, 19175869]
        ];
    }

    public function getAvgOToHGreater0Provider()
    {
        return [
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+3 day'), 4.15, 3, 3.53, 3.92, 19175869]
        ];
    }

    public function getAvgOToLLess0Provider()
    {
        return [
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+3 day'), 4.15, 3, 5, 3.92, 19175869]
        ];
    }

    public function getEODProvider()
    {
        return [
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+3 day'), 4.15, 3, 5, 3.92, 19175869]
        ];
    }

    public function getEODProvider_1()
    {
        return [
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+3 day'), 4.15, 3, 5, 8, 19175869]
        ];
    }

    public function getEODProvider_2()
    {
        return [
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+1 day'), 8.77, 9, 7.10, 10, 128045],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+2 day'), 9.65, 10.6, 6.80, 11, 15553620],
            [$this->createMock(\App\Entity\Ticker::class),new \DateTime('+3 day'), 4.15, 3, 5, 3.92, 19175869]
        ];
    }
}
