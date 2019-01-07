<?php

namespace App\Form;

use App\Entity\Coffee;
use App\Entity\Category;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoffeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'label' =>'Catégorie',
                'query_builder'=> function (EntityRepository $shelfcode) {
                    return $shelfcode->createQueryBuilder('c')
                        ->join('c.shelf', 's')
                        ->where('s.shelfCode = :shelfCode')
                        ->setParameter('shelfCode', 'COFFEE')
                        ->orderBy('c.title', 'ASC');
                },
                'choice_label' => 'title',
            ])
            ->add('country', CountryType::class, [
                'label'=>'Pays',
            ])
            ->add('soil', TextType::class, ['label'=>'Terroir'])
            ->add('variety', TextType::class, ['label'=>'Variété'])
            ->add('tastingNote', TextType::class, ['label'=>'Note de dégustation'])
            ->add('description', TextareaType::class, ['label'=>'Description'])
            ->add('highlighted', CheckboxType::class, ['required' => false, 'label' => 'Produit du mois'])
            ->add('novelty', CheckboxType::class, ['required' => false, 'label' => 'Nouveauté'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coffee::class,
        ]);
    }
}
