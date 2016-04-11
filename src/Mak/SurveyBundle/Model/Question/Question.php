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

use Mak\SurveyBundle\Model\Block;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author moein.ak@gmail.com
 */
abstract class Question extends Block
{
    /**
     * @var string
     */
    protected $text;

    /**
     * @var bool
     */
    protected $optional = false;

    /**
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @return boolean
     */
    public function isOptional()
    {
        return (boolean) $this->optional;
    }

    /**
     * @param boolean $optional
     */
    public function setOptional($optional)
    {
        $this->optional = $optional;
    }

    /**
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param int $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return array
     */
    protected function jsonSerializeQuestion()
    {
        return [
            'id' => $this->getId(),
            'text' => $this->getText(),
            'optional' => $this->isOptional(),
            'type' => $this->getType(),
        ];
    }
}
