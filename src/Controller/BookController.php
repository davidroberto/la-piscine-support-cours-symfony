<?php

declare( strict_types=1 );

namespace App\Controller;

use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class BookController extends AbstractController
{
	/**
	 * @Route("/books_by_genre", name="books_by_genre")
	 */
	public function getBooksByGenre(BookRepository $bookRepository)
	{

        $bookRepository->getByGenre();

        // appelle la méthode qu'on a créée dans le bookRepository ("getByGenre()")
        // Cette méthode est censée nous retourner tous les livres en fonction d'un genre
        // Elle va donc executer une requete SELECT en base de données
	}
}
