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

use Mak\SurveyBundle\Entity\Block;
use Mak\SurveyBundle\Entity\Page;

/**
 * @author moein.ak@gmail.com
 */
class PageRepository extends AbstractRepository
{
    public function save(Page $page)
    {
        $this->persist($page);
        $this->persist($page->getBlocks());
        $this->getEntityManager()->flush($page);
    }

    public function saveBlock(Block $block)
    {
        $this->persist($block);
        $this->getEntityManager()->flush($block);
    }
}