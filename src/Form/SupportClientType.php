<?php

namespace App\Form;

use App\Entity\SupportClient;
use App\Entity\TypeSupport;
use App\Entity\ZonesClient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupportClientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('zonesClient', EntityType::class, [
                'class' => ZonesClient::class,
                'choice_label' => 'id',
            ])
            ->add('typeSupport', EntityType::class, [
                'class' => TypeSupport::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SupportClient::class,
        ]);
    }
}
