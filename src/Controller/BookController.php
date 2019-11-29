<?php

declare( strict_types=1 );

namespace App\Controller;

use App\Entity\Book;
use App\Form\BookType;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
	/**
	 * @Route("/book/search", name="book_search")
	 */
	public function getBooksByGenre(BookRepository $bookRepository)
	{
        // appelle la méthode qu'on a créée dans le bookRepository ("getByGenre()")
        // Cette méthode est censée nous retourner tous les livres en fonction d'un genre
        // Elle va donc executer une requete SELECT en base de données
        $books = $bookRepository->getByGenre();

        dump($books); die;
	}


    /**
     * @Route("/book/insert", name="book_insert")
     */
	public function insertBook(EntityManagerInterface $entityManager)
    {
        // insérer dans la table book un nouveau livre
        $book = new Book();
        $book->setTitle('titre depuis le contr');
        $book->setAuthor('David Robert');
        $book->setGenre('escroquerie');
        $book->setInStock(true);
        $book->setNbPages(223);
        $book->setDate(new \DateTime());

        $entityManager->persist($book);
        $entityManager->flush();

        var_dump('livre enrgistré'); die;
    }

    // pouvoir supprimer un book en bdd

    /**
     * @Route("/book/delete", name="book_delete")
     */
    public function deleteBook(BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        // Je récupère un enregistrement book en BDD grâce au repository de book
        $book = $bookRepository->find(2);

        // j'utilise l'entity manager avec la méthode remove pour enregistrer
        // la suppression du book dans l'unité de travail
        $entityManager->remove($book);
        // je valide la suppression en bdd avec la méthode flush
        $entityManager->flush();

    }


    /**
     * @Route("/book/update", name="book_update")
     */
    public function updateBook(
        BookRepository $bookRepository,
        EntityManagerInterface $entityManager,
        AuthorRepository $authorRepository
    )
    {
        // j'utilise le Repository de l'entité Book pour récupérer un livre
        // en fonction de son id
        $book = $bookRepository->find(4);

        // Je récupère un auteur en fonction de son id
        $author = $authorRepository->find(1);

        // Je donne un nouveau titre à mon entité Book
        $book->setTitle('Les 11 clés du succès');
        $book->setGenre('Magie');

        // Dans mon livre, j'utilise le setter SetAuthor pour lui indiquer
        // quel est l'auteur relié à ce livre (attention, je dois lui
        // passer une entité author, et non juste un id)
        $book->setAuthor($author);

        // je re-enregistre mon livre en BDD avec l'entité manager
        $entityManager->persist($book);
        $entityManager->flush();

        dump('livre modifié'); die;
    }


    /**
     * @Route("/book/insert_form", name="book_insert_form")
     */
    public function insertBookForm(Request $request, EntityManagerInterface $entityManager)
    {

        // J'utilise le gabarit de formulaire pour créer mon formulaire
        // j'envoie mon formulaire à un fichier twig
        // et je l'affiche

        // je crée un nouveau Book,
        // en créant une nouvelle instance de l'entité Book
        $book = new Book();

        // J'utilise la méthode createForm pour créer le gabarit / le constructeur de
        // formulaire pour le Book : BookType (que j'ai généré en ligne de commandes)
        // Et je lui associe mon entité Book vide
        $bookForm = $this->createForm(BookType::class, $book);


        // Si je suis sur une méthode POST
        // donc qu'un formulaire a été envoyé
        if ($request->isMethod('Post')) {

            // Je récupère les données de la requête (POST)
            // et je les associe à mon formulaire
            $bookForm->handleRequest($request);

            // Si les données de mon formulaire sont valides
            // (que les types rentrés dans les inputs sont bons,
            // que tous les champs obligatoires sont remplis etc)
            if ($bookForm->isValid()) {

                // J'enregistre en BDD ma variable $book
                // qui n'est plus vide, car elle a été remplie
                // avec les données du formulaire
                $entityManager->persist($book);
                $entityManager->flush();
            }
        }



        // à partir de mon gabarit, je crée la vue de mon formulaire
        $bookFormView = $bookForm->createView();

        // je retourne un fichier twig, et je lui envoie ma variable qui contient
        // mon formulaire
        return $this->render('book/insert_form.html.twig', [
            'bookFormView' => $bookFormView
        ]);

    }

    /**
     * @Route("/book/update_form", name="book_update_form")
     */
    public function updateBookForm(BookRepository $bookRepository, Request $request, EntityManagerInterface $entityManager)
    {

        $book = $bookRepository->find(4);

        $bookForm = $this->createForm(BookType::class, $book);

        if ($request->isMethod('Post'))
        {
            $bookForm->handleRequest($request);

            if ($bookForm->isValid()) {
                $entityManager->persist($book);
                $entityManager->flush();
            }
        }

        // à partir de mon gabarit, je crée la vue de mon formulaire
        $bookFormView = $bookForm->createView();

        // je retourne un fichier twig, et je lui envoie ma variable qui contient
        // mon formulaire
        return $this->render('book/insert_form.html.twig', [
            'bookFormView' => $bookFormView
        ]);


    }

}
