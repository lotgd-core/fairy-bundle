<?php

/**
 * This file is part of "LoTGD Bundle Forest Fairy".
 *
 * @see https://github.com/lotgd-core/fairy-bundle
 *
 * @license https://github.com/lotgd-core/fairy-bundle/blob/master/LICENSE.txt
 * @author IDMarinas
 *
 * @since 0.1.0
 */

namespace Lotgd\Bundle\FairyBundle\Controller;

use Lotgd\Bundle\FairyBundle\LotgdFairyBundle;
use Lotgd\Bundle\FairyBundle\Pattern\ModuleUrlTrait;
use Lotgd\Core\Http\Request;
use Lotgd\Core\Http\Response as HttpResponse;
use Lotgd\Core\Log;
use Lotgd\Core\Navigation\Navigation;
use Lotgd\Core\Tool\PlayerFunction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Response;

class FairyController extends AbstractController
{
    use ModuleUrlTrait;

    public const TRANSLATION_DOMAIN = LotgdFairyBundle::TRANSLATION_DOMAIN;

    private $log;
    private $playerFunction;
    private $parameter;
    private $response;
    private $navigation;

    public function __construct(
        Log $log,
        PlayerFunction $playerFunction,
        ParameterBagInterface $parameter,
        HttpResponse $response,
        Navigation $navigation
    ) {
        $this->log            = $log;
        $this->playerFunction = $playerFunction;
        $this->parameter      = $parameter;
        $this->response       = $response;
        $this->navigation     = $navigation;
    }

    public function give(Request $request): Response
    {
        global $session;

        $this->response->pageStart('title.give', [], self::TRANSLATION_DOMAIN);

        $params = $this->addParamaters([
            'gived'          => false,
            'stamina_system' => is_module_active('staminasystem'),
        ]);

        if ($session['user']['gems'] > 0)
        {
            $params['gived'] = true;

            --$session['user']['gems'];
            $this->log->debug('gave 1 gem to a fairy');

            switch (mt_rand(1, 7))
            {
                case 1:
                    //## Added Stamina system support
                    $params['turns'] = $this->parameter->get('lotgd_bundle.fairy.awards.turn');
                    $params['case']  = 2;

                    if ($params['stamina_system'])
                    {
                        $params['case'] = 1;
                        require_once 'modules/staminasystem/lib/lib.php';

                        $stamina = $params['turns'] * 25000;
                        addstamina($stamina);
                        $this->log->debug('gained stamina for fairy in forest');
                    }
                    else
                    {
                        $this->log->debug('gained turns for fairy in forest');
                        $session['user']['turns'] += $params['turns'];
                    }

                break;
                case 2:
                case 3:
                    $params['case'] = 3;
                    $session['user']['gems'] += 2;
                    $this->log->debug('found 2 gem from a fairy');

                break;
                case 4:
                case 5:
                    $params['case']      = 4;
                    $params['permanent'] = 0;
                    $params['extra']     = $this->parameter->get('lotgd_bundle.fairy.awards.hitpoint');

                    if ($this->parameter->get('lotgd_bundle.fairy.permanent'))
                    {
                        $params['permanent'] = 1;
                        $session['user']['permahitpoints'] += $params['extra'];
                    }

                    $session['user']['maxhitpoints'] += $params['extra'];
                    $session['user']['hitpoints']    += $params['extra'];

                break;
                case 6:
                case 7:
                    $params['case'] = 5;
                    $this->playerFunction->incrementSpecialty('`^');

                break;
                default: break;
            }
        }
        else
        {
            --$session['user']['turns'];
        }

        $this->navigation->forestNav($request->query->get('translation_domain_navigation', ''));

        return $this->render('@LotgdFairy/give.html.twig', $params);
    }

    public function dont(Request $request): Response
    {
        $this->response->pageStart('title.dont', [], self::TRANSLATION_DOMAIN);

        $this->navigation->forestNav($request->query->get('translation_domain_navigation', ''));

        return $this->render('@LotgdFairy/dont.html.twig', $this->addParamaters([]));
    }

    private function addParamaters(array $params): array
    {
        $params['translation_domain'] = self::TRANSLATION_DOMAIN;

        return $params;
    }
}
