<?php

namespace App\DataFixtures;

use App\Entity\Industry;
use App\Entity\Sector;
use App\Entity\Tag;
use App\Entity\Ticker;
use App\Entity\TickerOpenToHi;
use App\Entity\TickerPerformance;
use App\Entity\DailyPrediction;
use App\Service\TickerAverageCalculator\TickerAverageCalculator20Gap;
use App\Service\TickerAverageFactory;
use App\Service\TickerOpenToHi20GapFactory;
use App\Service\TickerPerformanceFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    private $tickerPerformanceFactory;
    private $tickerFactory;

    public function __construct(TickerAverageFactory $tickerFactory, TickerPerformanceFactory $tickerPerformanceFactory)
    {
        $this->tickerPerformanceFactory = $tickerPerformanceFactory;
        $this->tickerFactory = $tickerFactory;
    }

    public function load(ObjectManager $manager)
    {
        $this->loadIndustry($manager);
        $this->loadSector($manager);
        $this->loadTags($manager);
        $this->loadTicker($manager);
        //$this->loadTickerPerformance($manager);
        //$this->loadTickerAverages($manager);
        //$this->loadTickerOpenToHiAvg($manager);
    }

    private function loadTags(ObjectManager $manager): void
    {
        foreach ($this->getTagData() as $index => $name) {
            $tag = new Tag();
            $tag->setName($name);

            $manager->persist($tag);
            $this->addReference('tag-'.$name, $tag);
        }

        $manager->flush();
    }

    private function loadIndustry(ObjectManager $manager): void
    {
        foreach ($this->getIndustryData() as $index => $name) {
            $ind = new Industry();
            $ind->setName($name);

            $manager->persist($ind);
            $this->addReference('ind-'.$name, $ind);
        }

        $manager->flush();
    }

    private function loadSector(ObjectManager $manager): void
    {
        foreach ($this->getSectorData() as $index => $name) {
            $sec = new Sector();
            $sec->setName($name);

            $manager->persist($sec);
            $this->addReference('sec-'.$name, $sec);
        }

        $manager->flush();
    }

    private function loadTicker(ObjectManager $manager): void
    {
        foreach ($this->getTickerData() as [$name, $summary])
        {
            $ticker = new Ticker();
            $ticker->setCode($name);
            $ticker->setSummary($summary);
            $ticker->setUpdated(New \DateTime());

            $manager->persist($ticker);
            $this->addReference($name, $ticker);
        }

        $manager->flush();
    }

//    private function loadTickerPerformance(ObjectManager $manager): void
//    {
//        $i=0;
//        $tname = NULL;
//        foreach ($this->getTickerPerformanceData() as [$tickerName, $dateTime, $open, $hi, $low, $close,
//                 $volume, $atr, $float, $shortFloat, $insidersOwn, $institutionOwn,
//                 $dilution, $marketCap, $news, $etb, $ssr, $floatRotation])
//        {
//
//            $tickerobj = $this->getReference($tickerName);
//
//            $tickerPerformance = $this->tickerPerformanceFactory::create(
//                                                                        $tickerobj,$dateTime,$open,
//                                                                        $hi,$low,$close,
//                                                                        $volume,$atr,$float,
//                                                                        $shortFloat,$insidersOwn,$institutionOwn,
//                                                                        $dilution,$marketCap,$news,
//                                                                        $etb,$ssr,$floatRotation,
//                                                                        $this->getRandomSector(),$this->getRandomIndustry());
//
//            $this->addReference('tp-'.$i++.$tickerName, $tickerPerformance);
//
//            $manager->persist($tickerPerformance);
//        }
//
//        $manager->flush();
//    }

//    private function loadTickerAverage(ObjectManager $manager): void
//    {
//        foreach ($this->getTickerData() as [$name])
//        {
//            $ticker = $this->tickerFactory::create($name, new TickerAverageCalculator20Gap(array()));
//
//            $manager->persist($ticker);
//            $this->addReference($name, $ticker);
//        }
//
//        $manager->flush();
//    }

//    private function loadTickerAverages(ObjectManager $manager): void
//    {
//        $array = [];
//        $i=0;
//
//        foreach ($this->getTickerPerformanceData() as [$tickerName])
//        {
//            $array[$tickerName][] = $this->getReference('tp-'.$i++.$tickerName);
//        }
//
//        foreach($array as $key => $tickerPerformanceArr)
//        {
//            $tickerObj = $this->getReference($tickerPerformanceArr[0]->getTicker()->getCode());
//
//            $ticker = $this->tickerFactory::updateAverages($tickerObj,
//                                            new TickerAverageCalculator20Gap($tickerPerformanceArr));
//            $manager->persist($ticker);
//        }
//
//        $manager->flush();
//    }

//    private function loadTickerOpenToHiAvg(ObjectManager $manager): void
//    {
//        $array = [];
//        $i=0;
//
//        foreach ($this->getTickerPerformanceData() as [$tickerName])
//        {
//            $array[$tickerName][] = $this->getReference('tp-'.$i++.$tickerName);
//        }
//
//        foreach($array as $key => $tickerPerformanceArr)
//        {
//            $tickerObj = $this->getReference($tickerPerformanceArr[0]->getTicker()->getCode());
//
//            if($tickerObj instanceof Ticker){
//
//                $factory = new TickerOpenToHi20GapFactory($tickerObj, $tickerPerformanceArr);
//                $tickerOpenToHi = $factory->create();
//
//                $manager->persist($tickerOpenToHi);
//            }
//        }
//
//        $manager->flush();
//    }

    private function getTickerData(): array
    {
        return[
          ['ANPC','Great stock'],
          ['XELA','Great stock2'],
          ['BLIN','Great stock3'],
          ['GALT','Great stock4']
        ];
    }

    /* $ticker, $dateTime, $open, $hi, $low, $close,$volume, $atr, $float, $shortFloat, $insidersOwn, $institutionOwn,$dilution, $marketCap, $news, $etb, $ssr, $floatRotation*/
    private function getTickerPerformanceData(): array
    {
        return [
            ['XELA',new \DateTime('+1 day'), 8.77, 9, 7.10, 7.43, 128045, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,3.00],
            ['XELA',new \DateTime('+2 day'), 9.65, 10.6, 6.80, 7.60, 15553620, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,5.00],
            ['XELA',new \DateTime('+3 day'), 10, 4.29, 3.53, 3.92, 19175869, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00],
            ['ANPC',new \DateTime('+1 day'), 12, 12.18, 11, 13.25, 322812, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00],
            ['ANPC',new \DateTime('+1 day'), 18, 11.2, 9.66, 20.12, 107381, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00],
            ['ANPC',new \DateTime('+1 day'), 16, 20.34, 9.66,10.12, 107381, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00],
            ['BLIN',new \DateTime('+1 day'), 6.14, 6.78, 4.73, 4.73, 80325699, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00],
            ['BLIN',new \DateTime('+1 day'), 6.11, 8.97, 6.0105, 8.97, 144081090, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00],
            ['GALT',new \DateTime('+1 day'), 0.2999, 0.5399, 0.2999,0.5399, 57130, 0.27, 2810, 0.410, 0.3222, 0.360, 1, 55776800,'AnPac Bio-Medical Stock Moves Higher On First Disease Treatment US Patent',1,0,1.00],
        ];
    }

    private function getRandomTags(): array
    {
        $tagNames = $this->getTagData();
        shuffle($tagNames);
        $selectedTags = \array_slice($tagNames, 0, random_int(2, 4));

        return array_map(function ($tagName) { return $this->getReference('tag-'.$tagName); }, $selectedTags);
    }

    private function getRandomSector(): object
    {
        $secNames = $this->getSectorData();
        shuffle($secNames);
        return $this->getReference('sec-'.$secNames[1]);
    }

    private function getRandomIndustry(): object
    {
        $indNames = $this->getIndustryData();
        shuffle($indNames);
        return $this->getReference('ind-'.$indNames[1]);
    }

    private function getTagData(): array
    {
        return [
            'lorem',
            'ipsum',
            'consectetur',
            'adipiscing',
            'incididunt',
            'labore',
            'voluptate',
            'dolore',
            'pariatur',
        ];
    }

    private function getIndustryData(): array
    {
        return [
            'Default',
            'Ind2',
            'Ind3',
            'Ind4',
            'Ind5'
        ];
    }

    private function getSectorData(): array
    {
        return [
            'Default',
            'sector2',
            'sector3',
            'sector4',
            'sector5',
            'sector6',
            'sector7',
            'sector8',
            'sector9'
        ];
    }

}
