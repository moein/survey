<?php

/*
 * This file is part of the Mak package.
 *
 * (c) Moein Akbarof <moein.ak@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mak\SurveyBundle\Repository;

use Mak\SurveyBundle\Model\Block;
use Mak\SurveyBundle\Model\Page;

/**
 * @author moein.ak@gmail.com
 */
class PageRepository extends AbstractRepository
{
    public function save(Page $page)
    {
        $this->persist($page);
        $this->getEntityManager()->flush();
    }

    public function saveBlock(Block $block)
    {
        $this->persist($block);
        $this->getEntityManager()->flush();
    }
}
