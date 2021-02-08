<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Adverts;
use App\Entity\Categories;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class Adverts1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class)
            ->add('image')
            ->add('content',CKEditorType::class)
            ->add('categories',EntityType::class,[
                'class' => Categories::class
            ])
            ->add('user',EntityType::class,[
                'class' => Users::class
            ])
            ->add('Valider',SubmitType::class)
            ->add('active')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adverts::class,
        ]);
    }
}
