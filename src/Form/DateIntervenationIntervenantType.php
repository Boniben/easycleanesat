<?php

namespace App\Form;

use App\Entity\DateIntervenationIntervenant;
use App\Entity\Intervenant;
use App\Entity\Intervention;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DateIntervenationIntervenantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_intervention')
            ->add('intervention', EntityType::class, [
                'class' => Intervention::class,
                'choice_label' => 'id',
            ])
            ->add('intervenant', EntityType::class, [
                'class' => Intervenant::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => DateIntervenationIntervenant::class,
        ]);
    }
}
