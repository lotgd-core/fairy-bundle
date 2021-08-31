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

namespace Lotgd\Bundle\FairyBundle\Pattern;

use Lotgd\Bundle\FairyBundle\Controller\FairyController;

trait ModuleUrlTrait
{
    public function getModuleUrl(string $method, string $query = '')
    {
        return "runmodule.php?method={$method}&controller=".urlencode(FairyController::class).$query;
    }
}
