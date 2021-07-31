<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 6/21/21
 * Time: 8:03 PM
 */

namespace App\Controller;

use App\Entity\Ticker;
use App\Form\TickerType;
use App\Repository\IndustryRepository;
use App\Repository\OpenToHiRepository;
use App\Repository\SectorRepository;
use App\Repository\TickerAverageRepository;
use App\Repository\TickerPerformanceRepository;
use App\Repository\TickerRepository;
use App\Service\ImporCSVTickerProcess;
use App\Service\ImporterCSV;
use App\Service\TickerAverageCalculator\TickerAverageCalculator20Gap;
use App\Service\TickerAverageCalculator\TickerAverageCalculatorByDay;
use App\Service\TickerAverageFactory;
use App\Service\TickerOpenToHi20GapFactory;
use App\Service\TickerOpenToHiByDayFactory;
use App\Service\TickerPerformanceFactory;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Validator\Constraints\DateTime;

class TickerController extends AbstractController
{
    /**
     * @Route("/", methods="GET", name="ticker_index")
     * @Cache(smaxage="10")
     */
    public function index(Request $request): Response
    {
        return $this->render('ticker/index.html.twig', []);
    }

    /**
     * @Route("/ticker/{code}", methods="GET", name="show_ticker")
     */
    public function tickerPerformanceDisplay(Ticker $ticker, TickerPerformanceRepository $tickerPerformanceRepository): Response
    {
        $tp1 = $tickerPerformanceRepository->findByDay($ticker,1);
        $tp2 = $tickerPerformanceRepository->findByDay($ticker,2);
        $tp3 = $tickerPerformanceRepository->findByDay($ticker,3);

        return $this->render('ticker/show_data.html.twig',
            [
                'ticker' => $ticker,
                'tickerPerformancesDay1'=>$tp1,
                'tickerPerformancesDay2'=>$tp2,
                'tickerPerformancesDay3'=>$tp3
            ]
        );
    }

    /**
     * @Route("/importCSV/{code}", methods="GET", name="import_csv")
     */
    public function importCVSTicker(Ticker $ticker, SectorRepository $sectorRepository,
                                    IndustryRepository $industryRepository, TickerAverageRepository $tickerAverageRepository,
                                    TickerPerformanceRepository $tickerPerformanceRepository)
    {
        $sector = $sectorRepository->findOneBy(array('name'=>'default'));
        $industry = $industryRepository->findOneBy(array('name'=>'default'));

        $filePath = $this->getParameter('csv_file_location').$ticker->getCode().".csv";

        $importer = new ImporCSVTickerProcess($tickerAverageRepository,
                                                $tickerPerformanceRepository,
                                                    $this->getDoctrine()->getManager());

        $rows = $importer->import($ticker, $sector, $industry, $filePath);

        return $this->json(array('rowCount'=> $rows));
    }

    /**
     * Creates a new Ticker entity.
     *
     * @Route("/new", methods="GET|POST", name="ticker_new")
     *
     */
    public function new(Request $request): Response
    {
        $ticker = new Ticker();

        $form = $this->createForm(TickerType::class, $ticker)
                        ->add('saveAndCreateNew', SubmitType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->persist($ticker);

            try {
                $em->flush();

                $this->addFlash('success', 'Ticker guardado!');

                if ($form->get('saveAndCreateNew')->isClicked()) {
                    return $this->redirectToRoute('ticker_new');
                }

                return $this->redirectToRoute('ticker_index');

            } catch (\Exception $e) {

                $errorMessage = $e->getMessage();
                $this->addFlash('danger', 'PDO Exception :'.$errorMessage);
            }

        }

        return $this->render('ticker/new.html.twig', [
            'ticker' => $ticker,
            'form' => $form->createView(),
        ]);
    }

//    /**
//     * @Route("/ticker/{code}", methods="GET", name="ticker_show")
//     */
//    public function tickerShow(Ticker $ticker): Response
//    {
//        // Symfony's 'dump()' function is an improved version of PHP's 'var_dump()' but
//        // it's not available in the 'prod' environment to prevent leaking sensitive information.
//        // It can be used both in PHP files and Twig templates, but it requires to
//        // have enabled the DebugBundle. Uncomment the following line to see it in action:
//        //
//        // dump($post, $this->getUser(), new \DateTime());
//
//        return $this->render('ticker/ticker_show.html.twig', ['ticker' => $ticker]);
//    }

//    /**
//     * @Route("/days/{code}", methods="GET", name="days")
//     */
//    public function days(Ticker $ticker,
//                         TickerPerformanceRepository $tickerPerformanceRepository,
//                         TickerRepository $tickerRepository)
//    {
//
//        $arrTP = $tickerPerformanceRepository->getLastDay($ticker);
//        var_dump($arrTP->getId());
//
//        return $this->json(array());
//    }

//    /**
//     * @Route("/search", methods="GET", name="ticker_search")
//     */
//    public function search(Request $request): Response
//    {
//        $query = $request->query->get('q', '');
//        $limit = $request->query->get('l', 10);
//
////        if (!$request->isXmlHttpRequest()) {
////            return $this->render('blog/search.html.twig', ['query' => $query]);
////        }
////
////        $foundPosts = $posts->findBySearchQuery($query, $limit);
////
//        $results = [];
////        foreach ($foundPosts as $post) {
////            $results[] = [
////                'title' => htmlspecialchars($post->getTitle(), \ENT_COMPAT | \ENT_HTML5),
////                'date' => $post->getPublishedAt()->format('M d, Y'),
////                'author' => htmlspecialchars($post->getAuthor()->getFullName(), \ENT_COMPAT | \ENT_HTML5),
////                'summary' => htmlspecialchars($post->getSummary(), \ENT_COMPAT | \ENT_HTML5),
////                'url' => $this->generateUrl('blog_post', ['slug' => $post->getSlug()]),
////            ];
////        }
//
//        return $this->json($results);
//    }

}