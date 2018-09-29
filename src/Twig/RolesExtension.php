<?php
/**
 * Created by PhpStorm.
 * User: romain
 * Date: 29/09/18
 * Time: 17:21
 */

namespace App\Twig;


use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class RolesExtension extends AbstractExtension
{
    public function getFilters()
    {
        return array(
            new TwigFilter('roles', array($this, 'rolesFilter')),
        );
    }

    public function rolesFilter($roles){
        switch ($roles){
            case 'ROLE_ADMIN':
                return 'administrateur';
            case 'ROLE_NATURALIST':
                return 'naturaliste';
            case 'ROLE_EDITOR':
                return 'éditeur';
            case 'ROLE_PARTICULAR':
                return 'observateur';
            default:
                return 'anonyme';
        }
    }
}