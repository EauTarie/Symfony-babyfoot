<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
//            ->add('created_at', null, [
//                'widget' => 'single_text',
//            ])
//            ->add('updated_at', null, [
//                'widget' => 'single_text',
//            ])
            ->add('occuring_at', null, [
                'widget' => 'single_text',
            ])
            ->add('duration')
            ->add('score')
            ->add('winningReason')
            ->add('id_team', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'id',
            ])
            ->add('secondTeam', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'id',
            ])
            ->add('winner', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
