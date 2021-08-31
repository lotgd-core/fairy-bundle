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

namespace Lotgd\Bundle\FairyBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder('lotgd_fairy');

        $treeBuilder->getRootNode()
            ->addDefaultsIfNotSet()
            ->children()
                ->booleanNode('permanent')
                    ->defaultFalse()
                    ->info('Is a permanent hitpoint or lost when kill Dragon?')
                ->end()
                ->arrayNode('awards')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->integerNode('hitpoint')
                            ->min(1)
                            ->max(5)
                            ->defaultValue(1)
                            ->info('How many Hitpoints given by the Fairy?')
                        ->end()
                        ->integerNode('turn')
                            ->min(1)
                            ->max(5)
                            ->defaultValue(1)
                            ->info('How many Turns give by the Fairy?')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}


// 'settings' => [
//     'Fairy Forest Event Settings,title',
//     'carrydk'   => 'Do max hitpoints gained carry across DKs?,bool|1',
//     'hptoaward' => 'How many HP are given by the fairy?,range,1,5,1|1',
//     'fftoaward' => 'How many FFs are given by the fairy?,range,1,5,1|1',
// ],
// 'prefs' => [
//     'Fairy Forest Event User Preferences,title',
//     'extrahps' => 'How many extra hitpoints has the user gained?,int',
// ],
// 'requires' => [
//     'lotgd' => '>=5.5.0|Need a version equal or greater than 5.5.0 IDMarinas Edition',
// ],
