<?php

namespace App\Form;

use App\DTO\SeriesCreateFromInput;
use App\Entity\Series;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeriesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('seriesName', TextType::class, ['label' => 'Nome:'])
            ->add('seasonsQuantity', NumberType::class, ['label' => 'Qtd Temporadas:'])
            ->add('episodesPerSeason', NumberType::class, ['label' => 'Ep por Temporada:'])
            ->add('save', SubmitType::class, ['label' => $options['is_edit'] ? 'Editar' : 'Adicionar'])
            ->setMethod($options['is_edit'] ? 'PATCH' : 'POST')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SeriesCreateFromInput::class,
            'is_edit' => false,
        ]);

        $resolver->setAllowedTypes('is_edit', 'bool');
    }
}
