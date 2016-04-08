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
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @author moein.ak@gmail.com
 *
 * @ORM\Entity(repositoryClass="Mak\SurveyBundle\Repository\SurveyRepository")
 */
class Survey implements \JsonSerializable
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
     * @ORM\Column(type="string", length=128, nullable=true)
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @var UserInterface
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     * @var Page[]
     * @ORM\OneToMany(targetEntity="Page", mappedBy="survey")
     */
    private $pages = [];

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Generates the code
     */
    public function generateCode()
    {
        if ($this->code) {
            throw new \LogicException(
                'The Survey::generateCode should be called only when the survey is saved.'
            );
        }
        $string = $this->getId() . mt_rand(1000, 9999) . uniqid() . mt_rand(1000, 9999);
        $this->code = hash('sha256', $string);
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
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param UserInterface $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return Page[]
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
     * @return Page
     */
    public function createPage()
    {
        $page = new Page($this);
        $this->pages[] = $page;

        return $page;
    }

    /**
     * {@inheritdoc}
     */
    function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'code' => $this->getCode(),
            'title' => $this->getTitle(),
            'description' => $this->getDescription()
        ];
    }
}