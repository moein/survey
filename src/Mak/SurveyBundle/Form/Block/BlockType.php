<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Form\Block;

use Mak\SurveyBundle\Form\AbstractType;
use Mak\SurveyBundle\Model\Block;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

/**
 * @author moein.ak@gmail.com
 */
class BlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'html',
                    'choice',
                    'date',
                    'paragraph',
                    'scale',
                    'text',
                    'time',
                ],
                'mapped' => false
            ])
        ;

        $builder->addEventListener(FormEvents::PRE_SUBMIT, function (FormEvent $event) {
            $type = $event->getData()['type'];
            $form = $event->getForm();

            if (Block::TYPE_HTML === $type) {
                $form->add('content', TextType::class);
            } else {
                $form->add('text', TextType::class);
                $form->add('optional', ChoiceType::class, [
                    'choices' => [0, 1]
                ]);
            }


            switch ($type)
            {
                case Block::TYPE_QUESTION_TIME:
                    $form->add('min', TimeType::class, [
                        'widget' => 'single_text'
                    ])
                    ->add('max', TimeType::class, [
                        'widget' => 'single_text'
                    ]);
                    break;
                case Block::TYPE_QUESTION_DATE:
                    $form->add('min', DateType::class, [
                        'widget' => 'single_text'
                    ])
                         ->add('max', DateType::class, [
                        'widget' => 'single_text'
                    ]);
                    break;
                case Block::TYPE_QUESTION_SCALE:
                    $form->add('min', DateType::class)
                         ->add('max', DateType::class)
                         ->add('minLabel', DateType::class)
                         ->add('maxLabel', DateType::class);
                    break;
                case Block::TYPE_QUESTION_CHOICE:
                    $form->add('choices', CollectionType::class, [
                        'property_path' => 'stringChoices',
                        'entry_type' => TextType::class,
                        'allow_add' => true,
                        'allow_delete' => true,
                    ]);
            }
        });
    }
}
