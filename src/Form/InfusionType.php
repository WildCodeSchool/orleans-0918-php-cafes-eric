<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Infusion;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InfusionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('ingredients')
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'label' => "Catégorie"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Infusion::class,
        ]);
    }
}
