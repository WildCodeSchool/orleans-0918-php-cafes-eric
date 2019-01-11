<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\FamilyInfusion;
use App\Entity\Infusion;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfusionType extends AbstractType
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
                        ->setParameter('shelfCode', 'INFUSION')
                        ->orderBy('c.title', 'ASC');
                },
                'choice_label' => 'title',
            ])
            ->add('family_infusion', EntityType::class, [
                'class' => FamilyInfusion::class,
                'choice_label' => 'name',
                'label' => "Type d'infusion "])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'help' => 'Ce nom doit être unique'])
            ->add('ingredients', TextType::class, ['label' => 'Ingrédients'])
            ->add('feature', TextType::class, [
                'required' => false,
                'label' => 'Particularité'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Infusion::class,
        ]);
    }
}
