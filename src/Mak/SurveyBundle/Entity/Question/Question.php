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

use Mak\SurveyBundle\Entity\Block;

use Doctrine\ORM\Mapping as ORM;

/**
 * @author moein.ak@gmail.com
 */
abstract class Question extends Block
{
    /**
     * @var string
     * @ORM\Column(type="string", length=200)
     */
    protected $text;

    /**
     * @var bool
     * @ORM\Column(type="boolean")
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
        return $this->optional;
    }

    /**
     * @param boolean $optional
     */
    public function setOptional($optional)
    {
        $this->optional = $optional;
    }

    /**
     * @return array
     */
    protected function jsonSerializeQuestion()
    {
        return [
            'id' => $this->getId(),
            'text' => $this->getText(),
            'optional' => $this->isOptional()
        ];
    }
}