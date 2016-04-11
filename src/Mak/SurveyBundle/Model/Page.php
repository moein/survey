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

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Mak\SurveyBundle\Model\Question\QuestionChoice;
use Mak\SurveyBundle\Model\Question\QuestionDate;
use Mak\SurveyBundle\Model\Question\QuestionParagraph;
use Mak\SurveyBundle\Model\Question\QuestionScale;
use Mak\SurveyBundle\Model\Question\QuestionText;
use Mak\SurveyBundle\Model\Question\QuestionTime;

/**
 * @author moein.ak@gmail.com
 */
class Page implements \JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $title;

    /**
     * @var Block[]|ArrayCollection
     */
    private $blocks = [];

    /**
     * @var Survey
     */
    private $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return Survey
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * @return Block[]|ArrayCollection
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @param string $type
     * @return Block
     */
    public function addBlock($type)
    {
        switch ($type) {
            case Block::TYPE_HTML:
                $block = new Html($this);
                break;
            case Block::TYPE_QUESTION_CHOICE:
                $block = new QuestionChoice($this);
                break;
            case Block::TYPE_QUESTION_DATE:
                $block = new QuestionDate($this);
                break;
            case Block::TYPE_QUESTION_PARAGRAPH:
                $block = new QuestionParagraph($this);
                break;
            case Block::TYPE_QUESTION_SCALE:
                $block = new QuestionScale($this);
                break;
            case Block::TYPE_QUESTION_TEXT:
                $block = new QuestionText($this);
                break;
            case Block::TYPE_QUESTION_TIME:
                $block = new QuestionTime($this);
                break;
            default:
                throw new \LogicException(sprintf('Invalid type %s provided!', $type));
        }
        $this->blocks[] = $block;

        return $block;
    }


    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'blocks' => $this->getBlocks()->toArray(),
        ];
    }
}
