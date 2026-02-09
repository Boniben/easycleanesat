<?php

namespace App\Form;

use App\Entity\Intervention;
use App\Entity\Vigilance;
use App\Entity\VigilanceIntervention;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VigilanceInterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('detail')
            ->add('vigilance', EntityType::class, [
                'class' => Vigilance::class,
                'choice_label' => 'id',
            ])
            ->add('intervention', EntityType::class, [
                'class' => Intervention::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VigilanceIntervention::class,
        ]);
    }
}
