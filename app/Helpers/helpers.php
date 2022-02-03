<?php

use Illuminate\Support\Str;

define('PAGELIST', 'liste');
define('PAGECREATEFORM', 'create');
define('PAGEEDITFORM', 'edit');
define('DEFAULTPASSWORD', 'password');

function userFullName()
{
    return auth()->user()->prenom . " " . auth()->user()->nom;
}

function setMenuClass($route, $classe)
{
    $routeActuel = request()->route()->getName();
    if(contains($routeActuel, $route))
    {
        return $classe;
    }
    return "";
}

function setMenuActive($route)
{
    $routeActuel = request()->route()->getName();
    if($routeActuel === $route)
    {
        return 'active';
    }
    return "";
}

function contains($container, $contenu)
{
    return Str::contains($container, $contenu);
}

function getRolesName()
{
    $roleName = "";
    $i = 1;
    foreach(auth()->user()->roles as $roles){
        $roleName .= $roles->nom;

        if($i < sizeof(auth()->user()->roles))
        {
            $roleName .= ', ';
        }
        $i++;
    }
    return  $roleName;
}


