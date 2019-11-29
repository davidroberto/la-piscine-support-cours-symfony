<?php

declare( strict_types=1 );

namespace App\Controller;

use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AuthorController extends AbstractController
{
	/**
	 * @Route("/author/list", name="author_list")
	 */
	public function authorList(AuthorRepository $authorRepository)
	{
	    $authors = $authorRepository->findAll();

		return $this->render( 'author/author_list.html.twig',
			[
                'authors' => $authors
			]
		);
	}
}
