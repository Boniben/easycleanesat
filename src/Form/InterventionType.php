<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\ElementSecurite;
use App\Entity\Intervention;
use App\Entity\Redacteur;
use App\Entity\ZonesClient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numVersion')
            ->add('dateCreation')
            ->add('dateModificaion')
            ->add('nbTravailleur')
            ->add('dureeHeure')
            ->add('dureeMinute')
            ->add('redacteur', EntityType::class, [
                'class' => Redacteur::class,
                'choice_label' => 'id',
                'required' => false,
            ])
            ->add('zonesClient', EntityType::class, [
                'class' => ZonesClient::class,
                'choice_label' => 'id',
                'required' => true,
            ])
            ->add('contrat', EntityType::class, [
                'class' => Contrat::class,
                'choice_label' => 'id',
                'required' => false,
            ])
            ->add('elementSecurites', EntityType::class, [
                'class' => ElementSecurite::class,
                'choice_label' => 'id',
                'multiple' => true,
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Intervention::class,
        ]);
    }
}
