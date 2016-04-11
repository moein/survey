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

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author moein.ak@gmail.com
 */
class QuestionDate extends Question
{
    /**
     * @var \DateTime
     * @Assert\Date()
     */
    private $min;

    /**
     * @var \DateTime
     * @Assert\Date()
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
    public function setMin(\DateTime $min = null)
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
    public function setMax(\DateTime $max = null)
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
                'min' => $this->getMin() ? $this->getMin()->format('Y-m-d') : null,
                'max' => $this->getMax() ? $this->getMax()->format('Y-m-d') : null,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'date';
    }
}
