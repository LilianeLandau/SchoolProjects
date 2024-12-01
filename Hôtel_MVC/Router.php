<?php

class Router
{

    public function getController(string $uri): array
    {
        //découper la route
        $explodeUri = explode('/', $uri);
        //récupérer le controller
        $controller = $explodeUri[1] ? ucfirst($explodeUri[1]) : 'Accueil';


        // var_dump($controller);
        //récupérer l'action
        $action = $explodeUri[2] ?? 'show';
        if ($controller === 'accueil') {
            $action = 'accueil';
        }
        //récupérer l'id 
        $id = $explodeUri[3] ?? null;

        //contruire le nom complet du controller
        $controller .= 'Controller';

        // var_dump($controller);

        return [
            'controller' => $controller,
            'action' => $action,
            'id' => $id,
        ];
    }
}
