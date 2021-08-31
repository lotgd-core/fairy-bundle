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

namespace Symfony\Component\DependencyInjection\Loader\Configurator;

use Lotgd\Bundle\FairyBundle\Controller\FairyController;
use Lotgd\Bundle\FairyBundle\OccurrenceSubscriber\FairySubscriber;
use Lotgd\Core\Http\Request;
use Lotgd\Core\Http\Response;
use Lotgd\Core\Navigation\Navigation;

return static function (ContainerConfigurator $container)
{
    $container->services()
    //-- Controllers
        ->set(FairyController::class)
        ->args([
            new ReferenceConfigurator('lotgd.core.log'),
            new ReferenceConfigurator('lotgd_core.tool.player_functions'),
            new ReferenceConfigurator('parameter_bag'),
            new ReferenceConfigurator(Response::class),
            new ReferenceConfigurator(Navigation::class),
        ])
        ->call('setContainer', [
            new ReferenceConfigurator('service_container'),
        ])
        ->tag('controller.service_arguments')

        //-- OccurrenceSubscriber
        ->set(FairySubscriber::class)
        ->args([
            new ReferenceConfigurator(Request::class),
            new ReferenceConfigurator(Navigation::class),
            new ReferenceConfigurator('lotgd.core.log'),
            new ReferenceConfigurator(Response::class),
            new ReferenceConfigurator('twig'),
        ])
        ->tag('lotgd_core.occurrence_subscriber')
    ;
};
