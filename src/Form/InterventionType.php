<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Contrat;
use App\Entity\ElementSecurite;
use App\Entity\Intervention;
use App\Entity\Redacteur;
use App\Entity\ZonesClient;
use Doctrine\ORM\EntityRepository;
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
        $clientId = $options['client_id'];
        
        $builder
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'nom',
                'placeholder' => 'Sélectionnez un client',
                'mapped' => false, 
                'required' => true,
                'data' => $clientId ? $options['em']->getRepository(Client::class)->find($clientId) : null,
                'query_builder' => function (EntityRepository $er) use ($clientId) {
                    $qb = $er->createQueryBuilder('c');
                    if ($clientId) {
                        $qb->where('c.id = :clientId')
                           ->setParameter('clientId', $clientId);
                    }
                    return $qb->orderBy('c.nom', 'ASC');
                },
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
            ->add('contrat', EntityType::class, [
                'class' => Contrat::class,
                'choice_label' => function (Contrat $contrat) {
                    $siteName = $contrat->getSitesClient() ? $contrat->getSitesClient()->getNom() : 'N/A';
                    return $contrat->getNumero();
                },
                'placeholder' => 'Sélectionnez un contrat',
                'required' => false,
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
            ->add('redacteur', EntityType::class, [
                'class' => Redacteur::class,
                'choice_label' => 'initial',
                'placeholder' => 'Sélectionnez un rédacteur',
                'required' => false,
            ])
            ->add('dateCreation', DateType::class, [
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
            'client_id' => null,
            'em' => null,
        ]);
    }
}
