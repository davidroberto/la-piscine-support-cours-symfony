<?php

namespace App\Form;

use App\Entity\Author;
use App\Entity\Book;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('genre', ChoiceType::class, [
                'choices' => [
                    'Thriller' => 'thriller',
                    'Policier' => 'policier',
                    'Autobio' => 'autobio'
                ]
            ])

            // Je créé un nouveau champs de formulaire
            // ce champs est pour la propriété 'author'
            // vu que ce champs contient une relation vers
            // une autre entité, le type choisi doit être
            // EntityType
            ->add('author', EntityType::class, [
                // je sélectionne l'entité à afficher, ici
                // Author car ma relation fait référence aux auteurs
                'class' => Author::class,
                // je choisi la propriété d'Author qui s'affiche
                // dans le select du html
                'choice_label' => 'lastName',
            ])

            ->add('inStock')
            ->add('nbPages')
            ->add('Envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
