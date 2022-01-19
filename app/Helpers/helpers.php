<?php

function userFullName()
{
    return auth()->user()->prenom . " " . auth()->user()->nom;
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
