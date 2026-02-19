<?php

namespace App\Form;

use App\Entity\Actions;
use App\Entity\Necessaire;
use App\Entity\TypeNecessaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NecessaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('code')
            ->add('type_necessaire', EntityType::class, [
                'class' => TypeNecessaire::class,
                'choice_label' => 'nom',
                'label' => 'Type',
                'placeholder' => 'Sélectionner un type',
            ])
            ->add('actions', EntityType::class, [
                'class' => Actions::class,
                'choice_label' => 'id',
                'multiple' => true,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Necessaire::class,
        ]);
    }
}
