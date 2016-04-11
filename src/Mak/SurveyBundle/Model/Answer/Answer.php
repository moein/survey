<?php

namespace Mak\SurveyBundle\Model\Answer;

use Mak\SurveyBundle\Model\Question\Question;
use Mak\SurveyBundle\Model\Response;

class Answer
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var Response
     */
    protected $response;

    /**
     * @var Question
     */
    protected $question;
}
