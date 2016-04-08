<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Form\Question;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @author moein.ak@gmail.com
 */
class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('text', TextType::class)
        ;
    }
}