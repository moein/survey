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
class Response
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var Survey
     */
    private $survey;

    /**
     * @var string
     */
    private $sessionToken;

    /**
     * @var Page
     */
    private $currentPage;

    /**
     * @var bool
     */
    private $finished = false;

    private $answers = [];
}
