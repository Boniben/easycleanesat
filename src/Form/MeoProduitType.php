<?php

namespace App\Form;

use App\Entity\Contenant;
use App\Entity\MeoProduit;
use App\Entity\MoyenDosage;
use App\Entity\Produit;
use App\Entity\TempsContact;
use App\Entity\UniteVolume;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MeoProduitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('volumeProduit')
            ->add('produit', EntityType::class, [
                'class' => Produit::class,
                'choice_label' => 'nom',
            ])
            ->add('contenant', EntityType::class, [
                'class' => Contenant::class,
                'choice_label' => 'nom',
            ])
            ->add('uniteVolume', EntityType::class, [
                'class' => UniteVolume::class,
                'choice_label' => 'nom',
            ])
            ->add('moyenDosage', EntityType::class, [
                'class' => MoyenDosage::class,
                'choice_label' => 'nom',
            ])
            ->add('tempsContact', EntityType::class, [
                'class' => TempsContact::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MeoProduit::class,
        ]);
    }
}
