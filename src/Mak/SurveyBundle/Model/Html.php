<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Model;

use Doctrine\ORM\Mapping as ORM;
use Mak\SurveyBundle\Value\HtmlContent;

/**
 * @author moein.ak@gmail.com
 */
class Html extends Block
{
    /**
     * @var string
     */
    private $content;

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->content = (string) new HtmlContent($content);
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
            'type' => $this->getType(),
            'content' => $this->getContent()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return 'html';
    }
}
