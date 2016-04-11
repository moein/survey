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

/**
 * @author moein.ak@gmail.com
 */
abstract class Block implements \JsonSerializable
{
    const TYPE_HTML = 'html';
    const TYPE_QUESTION_CHOICE = 'choice';
    const TYPE_QUESTION_DATE   = 'date';
    const TYPE_QUESTION_PARAGRAPH = 'paragraph';
    const TYPE_QUESTION_SCALE  = 'scale';
    const TYPE_QUESTION_TEXT   = 'text';
    const TYPE_QUESTION_TIME   = 'time';

    /**
     * @var int
     */
    protected $id;

    /**
     * @var Page
     */
    protected $page;

    /**
     * @var int
     */
    protected $position = 1;

    /**
     * @param Page $page
     */
    public function __construct(Page $page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function getPage()
    {
        return $this->page;
    }

    /**
     * @return string
     */
    abstract public function getType();
}
