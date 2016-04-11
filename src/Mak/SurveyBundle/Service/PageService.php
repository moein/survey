<?php

namespace Mak\SurveyBundle\Service;

use Mak\SurveyBundle\Model\Html;

class PageService
{
    public function createBlock(Page $page, $type)
    {
        switch ($type) {
            case 'html':
                return new Html($page);
        }
    }
}
