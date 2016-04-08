<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Controller;

use Mak\SurveyBundle\Entity\Html;
use Mak\SurveyBundle\Entity\Page;
use Mak\SurveyBundle\Entity\Survey;
use Mak\SurveyBundle\Form\SurveyType;
use Mak\SurveyBundle\Form\PageType;
use Mak\SurveyBundle\Repository\PageRepository;
use Mak\SurveyBundle\Repository\SurveyRepository;
use Mak\SurveyBundle\Value\HtmlContent;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * @author moein.ak@gmail.com
 * @Route("/page")
 */
class PageController extends Controller
{
    /**
     * @param Page $page
     * @return JsonResponse
     * @Route("/{id}/html")
     * @Method("POST")
     */
    public function addHtml(Page $page)
    {
        $html = $page->createHtml();
        $this->getRepository()->save($page);

        return new JsonResponse($html);
    }

    /**
     * @param Request $request
     * @param Html $html
     * @return JsonResponse
     * @Route("/html/{id}")
     * @Method("PUT")
     */
    public function updateHtml(Request $request, Html $html)
    {
        $content = $request->request->get('content', '');
        $htmlContent = new HtmlContent($content);

        $html->setContent($htmlContent);
        $this->getRepository()->saveBlock($html);

        return new JsonResponse($html);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return JsonResponse
     * @Route("/{id}/html")
     * @Method("POST")
     */
    public function addQuestion(Request $request, Page $page)
    {
        $this->createForm()
    }

    /**
     * @return PageRepository
     */
    private function getRepository()
    {
        return $this->get('mak_survey.page_repository');
    }
}