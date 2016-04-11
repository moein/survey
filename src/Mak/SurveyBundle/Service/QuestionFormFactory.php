<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Service;

use Mak\SurveyBundle\Model\Question;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;

/**
 * @author moein.ak@gmail.com
 */
class FormFactory
{
    const CLASS_MAPPING = [
        'date' => [
            'class' => Question\QuestionDate::class,
            'fields' => [
                'min' => DateType::class,
                'max' => DateType::class,
            ]
        ],
        'choice' => [
            'class' => Question\QuestionChoice::class,
            'fields' => [
                'choices' => CollectionType::class
            ]
        ],
        'paragraph' => [
            'class' => Question\QuestionParagraph::class,
            'fields' => []
        ],
        'scale' => [
            'class' => Question\QuestionScale::class,
            'fields' => [
                'min' => IntegerType::class,
                'minLabel' => TextType::class,
                'max' => IntegerType::class,
                'maxLabel' => TextType::class,
            ]
        ],
        'text' => [
            'class' => Question\QuestionText::class,
            'fields' => []
        ],
        'time' => [
            'class' => Question\QuestionTime::class,
            'fields' => [
                'min' => DateType::class,
                'max' => DateType::class,
            ]
        ],
    ];

    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function createForm($type)
    {

    }
}
