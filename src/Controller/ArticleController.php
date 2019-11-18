<?php

namespace App\Controller; // namespace de la classe actuelle

// namespace de la classe Response du composant HTPP foundation
// namespace de la classe Route utilisée en annotation
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// On étend la classe AbstractController pour bénéficier des méthodes et propriétés
// de cette classe dans notre contrôleur
class ArticleController extends AbstractController
{
    /**
     * Commentaire qui est une annotation et qui permet de créer
     * une url "/article" qui appelle la méthode "ArticleShow"
     *
     * Je passe en parametre de la méthode une variable $request, précédée par le nom
     * de la classe que je veux utiliser, et symfony va créer automatiquement l'instance de la
     * classe dans ma variable
     *
     * @Route("/article", name="article")
     */
    public function ArticleShow(Request $request)
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

        $response = new Response($request->query->get('id'));

        return $response;

    }

    /**
     * @Route("/product/{id}", name="product")
     */
    public function ProductShow($id)
    {
        var_dump($id); die;
    }

    /**
     * @Route("/admin", name="admin_connexion")
     */
    public function Connexion()
    {
        // génère une url pour la route dont le nom est "article"
        //$url = $this->generateUrl('article');

        // effectue une redirection vers la doc de Symfony
        //return $this->redirect($url);

        // cumule les deux méthodes 'generateUrl' et 'redirect'
        return $this->redirectToRoute('article');
    }

}
