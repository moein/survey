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
class QuestionTime extends Question
{
    /**
     * @var \DateTime
     * @Assert\Time()
     */
    private $min;

    /**
     * @var \DateTime
     * @Assert\Time()
     */
    private $max;

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
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return array_merge(
            $this->jsonSerializeQuestion(),
            [
                'min' => $this->getMin() ? $this->getMin()->format('H:i') : null,
                'max' => $this->getMax() ? $this->getMax()->format('H:i') : null,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'time';
    }
}
