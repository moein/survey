<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Model\Question;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mak\SurveyBundle\Model\Page;

/**
 * @author moein.ak@gmail.com
 */
class QuestionChoice extends Question
{
    /**
     * @var Choice[]|ArrayCollection
     */
    protected $choices;

    /**
     * @var bool
     */
    protected $multiple = false;

    /**
     * @var bool
     */
    protected $expanded = false;

    /**
     * @var array
     */
    protected $removedChoices = [];

    public function __construct(Page $page)
    {
        parent::__construct($page);
        $this->choices = new ArrayCollection();
    }

    /**
     * @return Choice[]|ArrayCollection
     */
    public function getChoices()
    {
        return $this->choices;
    }

    public function getStringChoices()
    {
        return array_map('strval', $this->getChoices()->toArray());
    }

    /**
     * @param Choice[] $choices
     */
    public function setStringChoices(array $choices)
    {
        $this->removedChoices = $this->choices;
        $currentChoicesCount = count($this->choices);
        foreach (array_values($choices) as $key => $choice) {
            if ($key < $currentChoicesCount) {
                $this->choices[$key]->setText($choice);
            } else {
                $this->choices[] = new Choice($this, $choice);
            }
        }
    }

    /**
     * @return array
     */
    public function getRemovedChoices()
    {
        return $this->removedChoices;
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
                'choices' => array_map('strval', $this->getChoices()->toArray()),
                'multiple' => $this->isMultiple(),
                'expanded' => $this->isExpanded(),
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'choice';
    }
}
