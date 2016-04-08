<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Entity\Question;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author moein.ak@gmail.com
 *
 * @ORM\Entity
 */
class QuestionChoice extends Question
{
    /**
     * @var Choice[]
     * @
     */
    protected $choices = [];

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $multiple = false;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
     */
    protected $expanded = false;

    /**
     * @return Choice[]
     */
    public function getChoices()
    {
        return $this->choices;
    }

    /**
     * @param Choice[] $choices
     */
    public function setChoices($choices)
    {
        $this->choices = $choices;
    }

    /**
     * @return boolean
     */
    public function isMultiple()
    {
        return $this->multiple;
    }

    /**
     * @param boolean $multiple
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }

    /**
     * @return boolean
     */
    public function isExpanded()
    {
        return $this->expanded;
    }

    /**
     * @param boolean $expanded
     */
    public function setExpanded($expanded)
    {
        $this->expanded = $expanded;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array_merge(
            $this->jsonSerializeQuestion(),
            [
                'choices' => $this->getChoices(),
                'multiple' => $this->isMultiple(),
                'expanded' => $this->isExpanded(),
            ]
        );
    }
}