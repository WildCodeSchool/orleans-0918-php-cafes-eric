<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\InfusionProduct;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfusionProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'label' => 'Catégorie'
            ])
            ->add('name',TextType::class, ['label'=> 'Nom'])
            ->add('description', TextType::class, ['label'=> 'Description'])
            ->add('tastingNote', TextType::class, ['label'=> 'Note de dégustation', 'required' => false])
            ->add('highlighted', CheckboxType::class, ['label'=> 'Produit du mois', 'required' => false])
            ->add('novelty', CheckboxType::class, ['label'=> 'Nouveautée', 'required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InfusionProduct::class,
        ]);
    }
}
