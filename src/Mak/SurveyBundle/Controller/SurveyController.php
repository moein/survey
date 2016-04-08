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

use Mak\SurveyBundle\Entity\Page;
use Mak\SurveyBundle\Entity\Survey;
use Mak\SurveyBundle\Form\SurveyType;
use Mak\SurveyBundle\Form\PageType;
use Mak\SurveyBundle\Repository\SurveyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @Route("/")
     * @Method("POST")
     * @return JsonResponse
     */
    public function create(Request $request)
    {
        $survey = new Survey();
        $form = $this->createForm(SurveyType::class, $survey);

        $form->submit($request->request->all());
        if ($form->isValid()) {
            return new JsonResponse([
                'errors' => $form->getErrors(true, true). ''
            ], JsonResponse::HTTP_BAD_REQUEST);
        }
        $surveyRepository = $this->getRepository();
        $surveyRepository->save($survey);
        $survey->generateCode();
        $surveyRepository->save($survey);

        return new JsonResponse($survey);
    }

    /**
     * @param Request $request
     * @param Survey $survey
     * @return JsonResponse
     * @Route("/{id}")
     * @Method("PUT")
     */
    public function update(Request $request, Survey $survey)
    {
        $form = $this->createForm(SurveyType::class, $survey);

        $form->submit($request->request->all());
        if ($form->isValid()) {
            return new JsonResponse([
                'errors' => $form->getErrors(true, true). ''
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $surveyRepository = $this->getRepository();
        $surveyRepository->save($survey);

        return new JsonResponse($survey);
    }

    /**
     * @param Request $request
     * @param Survey $survey
     * @return JsonResponse
     * @Route("/{id}/page")
     * @Method("POST")
     */
    public function addPage(Request $request, Survey $survey)
    {
        $page = $survey->createPage();
        $form = $this->createForm(PageType::class, $page);

        $form->submit($request->request->all());
        if ($form->isValid()) {
            return new JsonResponse([
                'errors' => $form->getErrors(true, true). ''
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $surveyRepository = $this->getRepository();
        $surveyRepository->save($survey);

        return new JsonResponse($page);
    }

    /**
     * @param Request $request
     * @param Page $page
     * @return JsonResponse
     * @Route("//page")
     * @Method("POST")
     */
    public function addHtml(Request $request, Page $page)
    {

    }

    /**
     * @return SurveyRepository
     */
    private function getRepository()
    {
        return $this->get('mak_survey.survey_repository');
    }
}