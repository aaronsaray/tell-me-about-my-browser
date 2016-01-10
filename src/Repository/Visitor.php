<?php
/**
 * Repository for visitors
 *
 * @author Aaron Saray
 */

namespace AboutBrowser\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class Visitor
 * @package AboutBrowser\Repository
 */
class Visitor extends EntityRepository
{
    /**
     * Get it by the public ID
     * @param $id
     * @return bool|\AboutBrowser\Model\Visitor
     */
    public function findOneByPublicID($id)
    {
        $internalID = base_convert($id, 36, 10);

        $dql = "select v from AboutBrowser\Model\Visitor v where v.id = {$internalID} and v.createdAt >= DATE_SUB(CURRENT_DATE(), 3, 'day')";

        $result = $this->_em->createQuery($dql)->getResult();
        return $result ? $result[0] : false;
    }
}