<?php

namespace App\Form;

use App\Entity\ElementSecurite;
use App\Entity\Intervention;
use App\Entity\Redacteur;
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
            ->add('dateModification')
            ->add('nbTravailleur')
            ->add('dureeHeure')
            ->add('dureeMinute')
            ->add('lundiMatHd')
            ->add('lundiMatHf')
            ->add('lundiApHd')
            ->add('lundiApHf')
            ->add('mardiMatHd')
            ->add('mardiMatHf')
            ->add('mardiApHd')
            ->add('mardiApHf')
            ->add('mercrediMatHd')
            ->add('mercrediMatHf')
            ->add('mercrediApHd')
            ->add('mercrediApHf')
            ->add('jeudiMatHd')
            ->add('jeudiMatHf')
            ->add('jeudiApHd')
            ->add('jeudiApHf')
            ->add('vendrediMatHd')
            ->add('vendrediMatHf')
            ->add('vendrediApHd')
            ->add('vendrediApHf')
            ->add('elementSecurites', EntityType::class, [
                'class' => ElementSecurite::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('redacteur', EntityType::class, [
                'class' => Redacteur::class,
                'choice_label' => 'id',
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
