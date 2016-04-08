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
use Mak\SurveyBundle\Entity\Survey;

/**
 * @author moein.ak@gmail.com
 */
class SurveyRepository extends AbstractRepository
{
    public function save(Survey $survey)
    {
        $this->persist($survey);
        $this->persist($survey->getPages());
        $this->getEntityManager()->flush($survey);
    }
}