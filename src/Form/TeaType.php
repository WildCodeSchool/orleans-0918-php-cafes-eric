<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Tea;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TeaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'title',
                'label' => "Catégorie"])
            ->add('name', TextType::class, [
                'label' => 'Nom',
                'help' => 'Ce nom doit être unique'])
            ->add('ingredients', TextType::class, ['label' => 'Ingrédients'])
            ->add('feature', TextType::class, [
                'required' => false,
                'label' => 'Particularité']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tea::class,
        ]);
    }
}