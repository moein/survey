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

use Mak\SurveyBundle\Entity\Question;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\Length;

/**
 * @author moein.ak@gmail.com
 */
class FormFactory
{
    const CLASS_MAPPING = [
        'checkbox' => [
            'class' => Question\QuestionCheckbox::class,
            'fields' => []
        ],
        'date' => [
            'class' => Question\QuestionDate::class,
            'fields' => [
                'min' => [
                    'type' => DateType::class
                ],
                'max' => DateType::class,
            ]
        ],
        'choice' => [
            'class' => Question\QuestionChoice::class,
            'fields' => []
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
            'class' => Question\QuestionCheckbox::class,
            'fields' => []
        ],
        'time' => [
            'class' => Question\QuestionCheckbox::class,
            'fields' => []
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