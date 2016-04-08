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
 */
class Page
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=30)
     */
    private $title;

    /**
     * @var Block[]
     * @ORM\OneToMany(targetEntity="Block", mappedBy="page")
     */
    private $blocks = [];

    /**
     * @var Survey
     * @ORM\ManyToOne(targetEntity="Survey", inversedBy="pages")
     */
    private $survey;

    public function __construct(Survey $survey)
    {
        $this->survey = $survey;
    }

    /**
     * @return Block[]
     */
    public function getBlocks()
    {
        return $this->blocks;
    }

    /**
     * @return Html
     */
    public function createHtml()
    {
        $html = new Html($this);
        $this->blocks[] = $html;

        return $html;
    }
}