<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\AppBundle\Entity;

use Mak\SurveyBundle\Model\UserInterface as SurveyUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author moein.ak@gmail.com
 *
 * @ORM\Entity(repositoryClass="Mak\AppBundle\Repository\UserRepository")
 */
class User implements SurveyUserInterface, UserInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(type="string", nullable=false, unique=true)
     */
    protected $email;

    /**
     * @var string
     * @ORM\Column(type="string", length=128, nullable=false, unique=true)
     */
    protected $token;

    /**
     * @param string $email
     */
    public function __construct($email)
    {
        $this->email = $email;
        $string = $this->getEmail() . mt_rand(1000, 9999) . uniqid() . mt_rand(1000, 9999);
        $this->token = hash('sha512', $string);
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles()
    {
        return ['ROLE_ADMIN'];
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
        throw new \LogicException('This method should not be called');
    }

    /**
     *
     */
    public function getSalt()
    {
        throw new \LogicException('This method should not be called');
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername()
    {
        return $this->getEmail();
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {

    }
}
