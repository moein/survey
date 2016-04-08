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

/**
 * @author moein.ak@gmail.com
 *
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="smallint")
 * @ORM\DiscriminatorMap({
 *  "0" = "Mak\SurveyBundle\Entity\Html",
 *  "1" = "Mak\SurveyBundle\Entity\Question\QuestionCheckbox",
 *  "2" = "Mak\SurveyBundle\Entity\Question\QuestionDate",
 *  "3" = "Mak\SurveyBundle\Entity\Question\QuestionChoice",
 *  "4" = "Mak\SurveyBundle\Entity\Question\QuestionParagraph",
 *  "5" = "Mak\SurveyBundle\Entity\Question\QuestionScale",
 *  "6" = "Mak\SurveyBundle\Entity\Question\QuestionText",
 *  "7" = "Mak\SurveyBundle\Entity\Question\QuestionTime"
 * })
 */
abstract class Block implements \JsonSerializable
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var Page
     * @ORM\ManyToOne(targetEntity="Page", inversedBy="pages")
     */
    protected $page;

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
}