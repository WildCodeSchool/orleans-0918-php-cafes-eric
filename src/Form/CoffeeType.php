<?php

namespace App\Form;

use App\Entity\Coffee;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CoffeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('country', CountryType::class, ['label'=>'pays'])
            ->add('terroir', TextType::class, ['label'=>'terroir'])
            ->add('variety', TextType::class, ['label'=>'variété'])
            ->add('tastingNote', TextType::class, ['label'=>'note'])
            ->add('description', TextType::class, ['label'=>'description'])
            ->add('highlighted', CheckboxType::class, ['label' =>'mise en avant'])
            ->add('novelty', CheckboxType::class, ['label' => 'nouveauté'])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'label' =>'Catégorie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Coffee::class,
        ]);
    }
}
