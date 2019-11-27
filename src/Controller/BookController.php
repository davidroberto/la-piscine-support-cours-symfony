<?php

declare( strict_types=1 );

namespace App\Controller;

use App\Entity\Book;
use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function updateBook(BookRepository $bookRepository, EntityManagerInterface $entityManager)
    {
        // j'utilise le Repository de l'entité Book pour récupérer un livre
        // en fonction de son id
        $book = $bookRepository->find(4);

        // Je donne un nouveau titre à mon entité Book
        $book->setTitle('Les 11 clés du succès');
        $book->setGenre('Magie');

        // je re-enregistre mon livre en BDD avec l'entité manager
        $entityManager->persist($book);
        $entityManager->flush();

        dump('livre modifié'); die;
    }


}
