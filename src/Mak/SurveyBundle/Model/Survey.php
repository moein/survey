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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author moein.ak@gmail.com
 */
class Survey implements \JsonSerializable
{
    const STATUS_DRAFT = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_CLOSED = 3;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $code;

    /**
     * @var string
     * @Assert\NotBlank
     * @Assert\Length(max=50)
     */
    private $title;

    /**
     * @var string
     * @Assert\Length(max=200)
     */
    private $description;

    /**
     * @var UserInterface
     */
    private $owner;

    /**
     * @var Page[]
     */
    private $pages = [];

    /**
     * @var int
     */
    private $status = self::STATUS_DRAFT;

    public function __construct(UserInterface $user)
    {
        $this->owner = $user;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return bool
     */
    public function hasId()
    {
        return !is_null($this->getId());
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
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
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return UserInterface
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * @param UserInterface $owner
     */
    public function setOwner($owner)
    {
        $this->owner = $owner;
    }

    /**
     * @return Page[]|ArrayCollection
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param Page $page
     */
    public function addPage(Page $page)
    {
        $this->pages[] = $page;
    }

    /**
     * @param string $title
     * @return Page
     */
    public function createPage($title = null)
    {
        $page = new Page($this);
        $page->setTitle($title);
        $this->pages[] = $page;

        return $page;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    public function activate()
    {
        $this->status = self::STATUS_ACTIVE;
        $this->generateCode();
    }

    /**
     * Generates the code
     */
    private function generateCode()
    {
        if (!$this->hasId())
        {
            throw new \LogicException('You should not call activate before saving the survey');
        }

        if ($this->code) {
            throw new \LogicException(
                'The Survey::generateCode should be called only when the survey is saved.'
            );
        }
        $string = $this->getId() . mt_rand(1000, 9999) . uniqid() . mt_rand(1000, 9999);
        $this->code = hash('sha512', $string);
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription(),
            'status' => $this->getStatus(),
            'pages' => $this->getPages()->toArray(),
            'code' => $this->getCode(),
        ];
    }
}
