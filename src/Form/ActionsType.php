<?php

namespace App\Form;

use App\Entity\Actions;
use App\Entity\Intervention;
use App\Entity\MeoProduit;
use App\Entity\Necessaire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('meo_produit', EntityType::class, [
                'class' => MeoProduit::class,
                'choice_label' => 'id',
            ])
            ->add('interventions', EntityType::class, [
                'class' => Intervention::class,
                'choice_label' => 'id',
                'multiple' => true,
                'required' => false,
            ])
            ->add('necessaire', EntityType::class, [
                'class' => Necessaire::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actions::class,
        ]);
    }
}
