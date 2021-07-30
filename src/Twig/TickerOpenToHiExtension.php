<?php
/**
 * Created by PhpStorm.
 * User: Gastón Cortés
 * Date: 7/21/21
 * Time: 4:27 PM
 */

namespace App\Twig;

use App\Entity\Ticker;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
class TickerOpenToHiExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('getOpenToHiProbabilities', [$this, 'getOpenToHi']),
        ];
    }

    public function getOpenToHi(Ticker $ticker, $range, $day)
    {
        $tickerOpenToHi = $ticker->{'getOpenToHiPercentageDay'.$day}();
        return $tickerOpenToHi->{$range}();
    }
}