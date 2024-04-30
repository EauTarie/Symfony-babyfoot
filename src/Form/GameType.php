<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Team;


use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('occuring_at', null, [
                'widget' => 'single_text',
            ])
            ->add('duration')


        ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            $game = $event->getData();
            $form = $event->getForm();

            if (!$game || $game->getScore() === null) {
                $form->add('firstTeam', EntityType::class, [
                    'class' => Team::class,
                    'choice_label' => 'name',
                ]);
                $form->add('secondTeam', EntityType::class, [
                        'class' => Team::class,
                        'choice_label' => 'name',
                    ]);
            }

            if ($game && $game->getId() != null) {
                $form->add('score', TextType::class);
                $form->add('winningReason', TextType::class);
                $form->add('winner', ChoiceType::class, [
                    'choices' => [
                        'Equipe Gagnante' => [
                            $game->getFirstTeam()->getName()=> $game->getFirstTeam(),
                            $game->getSecondTeam()->getName()=> $game->getSecondTeam()
                        ]
                    ]
                ]);
            }
            })
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
