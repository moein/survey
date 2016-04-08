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
class QuestionScale extends Question
{
    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $min = 1;

    /**
     * @var int
     * @ORM\Column(type="string", length=15)
     */
    private $minLabel;

    /**
     * @var int
     * @ORM\Column(type="smallint")
     */
    private $max = 5;

    /**
     * @var int
     * @ORM\Column(type="string", length=15)
     */
    private $maxLabel;

    /**
     * @return int
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param int $min
     */
    public function setMin($min)
    {
        $this->min = $min;
    }

    /**
     * @return int
     */
    public function getMinLabel()
    {
        return $this->minLabel;
    }

    /**
     * @param int $minLabel
     */
    public function setMinLabel($minLabel)
    {
        $this->minLabel = $minLabel;
    }

    /**
     * @return int
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param int $max
     */
    public function setMax($max)
    {
        $this->max = $max;
    }

    /**
     * @return int
     */
    public function getMaxLabel()
    {
        return $this->maxLabel;
    }

    /**
     * @param int $maxLabel
     */
    public function setMaxLabel($maxLabel)
    {
        $this->maxLabel = $maxLabel;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array_merge(
            $this->jsonSerializeQuestion(),
            [
                'min' => $this->getMin(),
                'minLabel' => $this->getMinLabel(),
                'max' => $this->getMax(),
                'maxLabel' => $this->getMaxLabel(),
            ]
        );
    }
}