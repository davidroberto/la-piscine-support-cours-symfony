<?php

namespace App\Controller; // namespace de la classe actuelle

// namespace de la classe Response du composant HTPP foundation
// namespace de la classe Route utilisée en annotation
use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/articleStatic", name="article_static")
     */
    public function articleShow(Request $request)
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
    public function productShow($id)
    {
        var_dump($id); die;
    }

    /**
     * @Route("/admin", name="admin_connexion")
     */
    public function connexion()
    {
        // génère une url pour la route dont le nom est "article"
        //$url = $this->generateUrl('article');

        // effectue une redirection vers la doc de Symfony
        //return $this->redirect($url);

        // cumule les deux méthodes 'generateUrl' et 'redirect'
        return $this->redirectToRoute('article');
    }


    /**
     * @Route("/article", name="article")
     */
    public function twigArticle()
    {
        // récupère et compile le contenu d'un fichier Twig
        // en html, et le renvoie en réponse

        // on simule des données récupérées depuis la bdd
        $title = 'titre de ma page';
        $content = 'contenu de ma page';

        $displaySidebar = false;

        $relatedArticles = [
            '<p>article associé 1</p>',
            '<p>aarticle associé 2</p>',
            '<p>aarticle associé 3</p>',
            '<p>aarticle associé 4</p>'
        ];

        // utilisation de la méthode render pour appeler un fichier Twig et le compiler en html
        // en lui envoyant des variables
        return $this->render('article.html.twig', [
            'title' => $title,
            'content' => $content,
            'displaySidebar' => $displaySidebar,
            'relatedArticles' => $relatedArticles
        ]);
    }

    /**
     * @Route("/", name="article_list")
     */
    public function ArticleList()
    {
        return $this->render('articleList.html.twig');
    }

    /**
     * @Route("/article_db_list", name="article_db_list")
     */
    public function ArticlesDbList(ArticleRepository $articleRepository)
    {
        $articles = $articleRepository->findAll();
    }

}
