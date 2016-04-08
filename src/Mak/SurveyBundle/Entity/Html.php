<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Mak\SurveyBundle\Value\HtmlContent;

/**
 * @author moein.ak@gmail.com
 *
 * @ORM\Entity
 */
class Html extends Block
{
    /**
     * @var string
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    private $content;

    /**
     * @param HtmlContent $content
     */
    public function setContent(HtmlContent $content)
    {
        $this->content = (string) $content;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'content' => $this->getContent()
        ];
    }
}