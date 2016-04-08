<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Value;

/**
 * @author moein.ak@gmail.com
 */
class HtmlContent
{
    const ALLOWED_TAGS = [
        'br',
        'p',
        'pre',
        'span',
        'div',
        'h1',
        'h2',
        'h3',
        'h4',

    ];

    private $content;

    public function __construct($content)
    {
        $this->content = strip_tags($content, $this->getAllowedTags());
    }

    private function getAllowedTags()
    {
        return implode('', array_map([$this, 'wrapTag'], static::ALLOWED_TAGS));
    }

    public function wrapTag($tag)
    {
        return "<$tag>";
    }

    public function __toString()
    {
        return $this->content;
    }
}