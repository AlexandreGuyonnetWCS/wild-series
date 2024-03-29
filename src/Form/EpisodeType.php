<?php

namespace App\Form;

use App\Entity\Episode;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EpisodeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('number')
            ->add('synopsis')
            ->add('season',null, [
                'label' => 'Season',
                'choice_label' => 'number',
                'placeholder' => 'Choose a season',
            ]);
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Episode::class,
        ]);
    }
}
