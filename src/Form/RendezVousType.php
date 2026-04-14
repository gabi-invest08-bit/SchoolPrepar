<?php

namespace App\Form;

use App\Entity\Mentor;
use App\Entity\RendezVous;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RendezVousType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date')
            ->add('statut')
            ->add('eleve', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('mentor', EntityType::class, [
                'class' => Mentor::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RendezVous::class,
        ]);
    }
}
