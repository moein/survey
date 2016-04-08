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
class QuestionDate extends Question
{
    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    private $min;

    /**
     * @var \DateTime
     * @ORM\Column(type="date")
     */
    private $max;

    /**
     * @return \DateTime
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param \DateTime $min
     */
    public function setMin(\DateTime $min)
    {
        $this->min = $min;
    }

    /**
     * @return \DateTime
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param \DateTime $max
     */
    public function setMax(\DateTime $max)
    {
        $this->max = $max;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array_merge(
            $this->jsonSerializeQuestion(),
            [
                'min' => $this->getMin()->format('Y-m-d'),
                'max' => $this->getMax()->format('Y-m-d'),
            ]
        );
    }
}