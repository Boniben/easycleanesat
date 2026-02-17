<?php

namespace App\Form;

use App\Entity\Contrat;
use App\Entity\ElementSecurite;
use App\Entity\Intervention;
use App\Entity\Redacteur;
use App\Entity\ZonesClient;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InterventionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('client', EntityType::class, [
                'class' => ZonesClient::class,
                'choice_label' => function (ZonesClient $client) {
                    return $clientName = $client->getSitesClient() && $client->getSitesClient()->getClient() 
                        ? $client->getSitesClient()->getClient()->getNom() 
                        : 'N/A';    
                // return $client->getNom();
                },
                'placeholder' => 'Sélectionnez un client',
                'mapped' => false, 
                'required' => true,
            ])
            ->add('site', EntityType::class, [
                'class' => ZonesClient::class,
                'choice_label' => function (ZonesClient $site) {
                    return $siteName = $site->getSitesClient() ? $site->getSitesClient()->getNom() : 'N/A';
                },
                'placeholder' => 'Sélectionnez un site',
                'mapped' => false, 
                'required' => true,
            ])
            ->add('zonesClient', EntityType::class, [
                'class' => ZonesClient::class,
                'choice_label' => function (ZonesClient $zone) {
                    $siteName = $zone->getSitesClient() ? $zone->getSitesClient()->getNom() : 'N/A';
                    return $zone->getNom();
                },
                'placeholder' => 'Sélectionnez une zone',
                'required' => true,
            ])
            ->add('contrat', EntityType::class, [
                'class' => Contrat::class,
                'choice_label' => function (Contrat $contrat) {
                    $siteName = $contrat->getSitesClient() ? $contrat->getSitesClient()->getNom() : 'N/A';
                    return $contrat->getNumero() . ' (' . $siteName . ')';
                },
                'placeholder' => 'Sélectionnez un contrat',
                'required' => false,
            ])
            ->add('redacteur', EntityType::class, [
                'class' => Redacteur::class,
                'choice_label' => 'initial',
                'placeholder' => 'Sélectionnez un rédacteur',
                'required' => false,
            ])
            ->add('numVersion')
            ->add('dateCreation', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'attr' => ['placeholder' => 'jj/mm/aaaa'],
            ])
            ->add('dateModificaion', DateType::class, [
                'widget' => 'single_text',
                'format' => 'dd/MM/yyyy',
                'html5' => false,
                'attr' => ['placeholder' => 'jj/mm/aaaa'],
            ])
            ->add('nbTravailleur', IntegerType::class, [
                'attr' => [
                    'min' => 1,
                    'max' => 6,
                ],
            ])
            ->add('dureeHeure')
            ->add('dureeMinute')
            ->add('elementSecurites', EntityType::class, [
                'class' => ElementSecurite::class,
                'choice_label' => 'nom',
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
