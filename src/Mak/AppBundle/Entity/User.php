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

use Mak\SurveyBundle\Entity\UserInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @author moein.ak@gmail.com
 *
 * @ORM\Entity
 */
class User implements UserInterface
{
    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;
}