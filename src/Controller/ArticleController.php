<?php

namespace App\Controller; // namespace de la classe actuelle

// namespace de la classe Response du composant HTPP foundation
// namespace de la classe Route utilisée en annotation
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController
{
    /**
     * Commentaire qui est une annotation et qui permet de créer
     * une url "/article" qui appelle la méthode "ArticleShow"
     *
     * @Route("/article", name="article")
     */
    public function ArticleShow()
    {
        // Réponse non valide (le var dump n'est pas une réponse HTTP correcte)
        //var_dump('hello world');

        // Réponse HTTP valide
        // Par défaut, le code renvoyé est 200, et le contenu 'html'

        // Appel de la méthode 'createFromGlobals' de la classe Request
        // cela permet de récupérer toutes les données de la requête de l'utilisateur
        // dans une seule classe
        // cela contient :
        //    $_GET,
        //    $_POST,
        //    $_COOKIE,
        //    $_FILES,
        //    $_SERVER

        $request = Request::createFromGlobals();

        // récupération d'un parametre d'url id
        dump($request->query->get('id'));

        die;

        $response = new Response();

        return $response;

    }
}
