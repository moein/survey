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

use Doctrine\ORM\EntityRepository;

/**
 * @author moein.ak@gmail.com
 */
class AbstractRepository extends EntityRepository
{
    protected function persist($entities)
    {
        if (!is_array($entities)) {
            $entities = [$entities];
        }
        foreach ($entities as $entity) {
            $this->getEntityManager()->persist($entity);
        }
    }
}
