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

namespace Lotgd\Bundle\FairyBundle\OccurrenceSubscriber;

use Lotgd\Bundle\FairyBundle\LotgdFairyBundle;
use Lotgd\Bundle\FairyBundle\Pattern\ModuleUrlTrait;
use Lotgd\Core\Http\Request;
use Lotgd\Core\Http\Response;
use Lotgd\Core\Log;
use Lotgd\Core\Navigation\Navigation;
use Lotgd\CoreBundle\OccurrenceBundle\OccurrenceSubscriberInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Twig\Environment;

class FairySubscriber implements OccurrenceSubscriberInterface
{
    use ModuleUrlTrait;

    public const TRANSLATION_DOMAIN = LotgdFairyBundle::TRANSLATION_DOMAIN;

    private $request;
    private $navigation;
    private $log;
    private $response;
    private $twig;

    public function __construct(
        Request $request,
        Navigation $navigation,
        Log $log,
        Response $response,
        Environment $twig
    ) {
        $this->request    = $request;
        $this->navigation = $navigation;
        $this->log        = $log;
        $this->response   = $response;
        $this->twig       = $twig;
    }

    public function onForest(GenericEvent $event)
    {
        $params = [
            'translation_domain' => self::TRANSLATION_DOMAIN,
        ];

        $this->navigation->setTextDomain(self::TRANSLATION_DOMAIN);

        $translationDomain = sprintf('&translation_domain=%s&translation_domain_navigation=%s&navigation_method=%s',
            $event->getArgument('translation_domain'),
            $event->getArgument('translation_domain_navigation'),
            $event->hasArgument('navigation_method') ? $event->getArgument('navigation_method') : '',
        );

        $this->navigation->addNav('navigation.nav.give.yes', $this->getModuleUrl('give', $translationDomain));
        $this->navigation->addNav('navigation.nav.give.no', $this->getModuleUrl('dont', $translationDomain));

        $this->navigation->setTextDomain();

        $this->response->pageAddContent($this->twig->render('@LotgdFairy/encounter.html.twig', $params));

        $event->stopPropagation();
    }

    public static function getSubscribedOccurrences()
    {
        return [
            'forest' => ['onForest', 8000, OccurrenceSubscriberInterface::PRIORITY_ANSWER],
        ];
    }
}
