<?php

namespace App\Controller; // namespace de la classe actuelle

// namespace de la classe Response du composant HTPP foundation
// namespace de la classe Route utilisée en annotation
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

        $response = new Response();

        return $response;

    }
}
