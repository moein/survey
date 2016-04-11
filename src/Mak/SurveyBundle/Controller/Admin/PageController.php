<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Controller\Admin;

use Mak\SurveyBundle\Form\Block\BlockType;
use Mak\SurveyBundle\Model\Block;
use Mak\SurveyBundle\Model\Page;
use Mak\SurveyBundle\Repository\PageRepository;
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
     * @param Request $request
     * @return JsonResponse
     * @Route("/{id}/block")
     * @Method("POST")
     */
    public function addBlock(Page $page, Request $request)
    {
        $block = $page->addBlock($request->request->get('type'));
        $form = $this->createForm(BlockType::class, $block);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return new JsonResponse([
                'errors' => $form->getErrors(true). ''
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->getRepository()->save($page);

        return new JsonResponse($page);
    }

    /**
     * @param Block $block
     * @param Request $request
     * @return JsonResponse
     * @Route("/block/{id}")
     * @Method("POST")
     */
    public function updateBlock(Block $block, Request $request)
    {
        $form = $this->createForm(BlockType::class, $block);
        $data = $request->request->all();
        $data['type'] = $block->getType();
        $form->submit($data);
        if (!$form->isValid()) {
            return new JsonResponse([
                'errors' => $form->getErrors(true). ''
            ], JsonResponse::HTTP_BAD_REQUEST);
        }

        $this->getRepository()->saveBlock($block);

        return new JsonResponse($block);
    }

    /**
     * @param Page $page
     * @return JsonResponse
     * @Route("/{id}")
     * @Method("GET")
     */
    public function getPage(Page $page)
    {
        return new JsonResponse($page);
    }

    /**
     * @return PageRepository
     */
    private function getRepository()
    {
        return $this->get('mak_survey.page_repository');
    }
}
