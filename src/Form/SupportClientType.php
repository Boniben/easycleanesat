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
        // Ajoutez les champs du formulaire pour SupportClient
        $builder
            ->add('zonesClient', EntityType::class, [
                'class' => ZonesClient::class,
                'choice_label' => 'nom',
                'label' => 'Zone',
            ])
            ->add('typeSupport', EntityType::class, [
                'class' => TypeSupport::class,
                'choice_label' => 'nom',
                'label' => 'Type de support',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Configurez les options du formulaire pour SupportClient
        $resolver->setDefaults([
            'data_class' => SupportClient::class,
        ]);
    }
}
