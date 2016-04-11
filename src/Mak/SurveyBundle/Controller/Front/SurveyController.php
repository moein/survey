<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Controller\Front;

use Mak\SurveyBundle\Model\Survey;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @author moein.ak@gmail.com
 * @Route("/survey")
 */
class SurveyController extends Controller
{
    /**
     * @param Survey $survey
     * @param Request $request
     * @return JsonResponse
     * @Route("/{code}")
     * @Method("POST")
     */
    public function addBlock(Survey $survey, Request $request)
    {


        return new JsonResponse([
            'title' => $survey->getTitle(),
            'pages' => $survey->getPages()->toArray(),
        ]);
    }
}
