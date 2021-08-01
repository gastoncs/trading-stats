<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/24/21
 * Time: 3:44 PM
 */

namespace App\Service;


use App\Entity\Industry;
use App\Entity\Sector;
use App\Entity\Ticker;
use App\Entity\TickerPerformance;
use App\Repository\OpenToHiRepository;
use App\Repository\TickerAverageRepository;
use App\Repository\TickerPerformanceRepository;
use App\Service\TickerAverageCalculator\TickerAverageCalculatorByDay;
use Doctrine\Persistence\ObjectManager;

class ImporCSVTickerProcess
{
    private $em;
    private $tickerAverageRepository;
    private $tickerPerformanceRepository;

    public function __construct(TickerAverageRepository $tickerAverageRepository,
                                TickerPerformanceRepository $tickerPerformanceRepository,
                                ObjectManager $em)
    {
        $this->em = $em;
        $this->tickerAverageRepository = $tickerAverageRepository;
        $this->tickerPerformanceRepository = $tickerPerformanceRepository;
    }

    public function import(Ticker $ticker, Sector $sector, Industry $industry, $filePath)
    {
        $i=0;
        $j=0;
        $arrTickerPerformance=[];

        try{

            $cvsData = ImporterCSV::importCSV($filePath);

            $dataBaseDateObj =  $this->tickerPerformanceRepository->getLastDay($ticker);

            $dbDate = null;

            if($dataBaseDateObj instanceof TickerPerformance){
                $dbDate = $dataBaseDateObj->getDate()->format("Y-m-d");
            }

            foreach ($cvsData as $key=>$value){

                if($i > 0){

                    $dateTime = $value[0];

                    $csvDate = \DateTime::createFromFormat("Y/m/d", $dateTime);

                    if (!$csvDate){
                        throw new \UnexpectedValueException("Could not parse the date: $dateTime");
                    }

                    if($csvDate->format('Y-m-d') > $dbDate){

                        $open = $value[3];
                        $hi = $value[1];
                        $low = $value[2];
                        $close = $value[4];
                        $volume = $value[5];

                        //Process 2 Create Ticker Performance from CSV data
                        $tickerPerformance = TickerPerformanceFactory::create(
                            $ticker,$csvDate,$open,$hi,$low,$close,$volume, $atr=0.00, $float=0.00, $shortFloat=0.00,
                            $insidersOwn=0.00, $institutionOwn=0.00, $dilution=0.00, $marketCap=0.00, $news=null,
                            $etb=0,$ssr=0, $floatRotation=0, $sector, $industry);

                        $this->em->persist($tickerPerformance);

                        $arrTickerPerformance[] = $tickerPerformance;
                        $j++;
                    }
                }

                $i++;
            }

            if($j > 0){

                $this->em->flush();

                $ticketAverages = $this->tickerAverageRepository->findBy(array('ticker' =>$ticker->getId()));

                //Process 3 Create Ticker Average base on Ticker Performance Data
                if(0 == count($ticketAverages)){
                    $this->em->persist(TickerAverageFactory::create($ticker, new TickerAverageCalculatorByDay($this->tickerPerformanceRepository), 1));
                    $this->em->persist(TickerAverageFactory::create($ticker, new TickerAverageCalculatorByDay($this->tickerPerformanceRepository), 2));
                    $this->em->persist(TickerAverageFactory::create($ticker, new TickerAverageCalculatorByDay($this->tickerPerformanceRepository), 3));
                }

                //Process 4 Calculate gap probability
                $factory = new TickerOpenToHiByDayFactory($ticker, $arrTickerPerformance, 1);
                $this->em->persist($factory->create());

                $factory = new TickerOpenToHiByDayFactory($ticker, $arrTickerPerformance, 2);
                $this->em->persist($factory->create());

                $factory = new TickerOpenToHiByDayFactory($ticker, $arrTickerPerformance, 3);
                $this->em->persist($factory->create());

                $this->em->flush();
            }

            return $j;

        }catch (\Exception $e){
            throw new \ErrorException($e->getMessage());
        }
    }
}