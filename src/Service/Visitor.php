<?php
/**
 * The visitor service
 *
 * @author Aaron Saray
 */

namespace AboutBrowser\Service;

use AboutBrowser\Model;

/**
 * Class Visitor
 * @package AboutBrowser\Service
 */
class Visitor
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManager $entityManager
     */
    public function __construct(\Doctrine\ORM\EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * Stores the data and returns the unique public ID
     *
     * @param $data
     * @return string
     */
    public function storeNewVisitor($data)
    {
        $visitor = new Model\Visitor();
        $visitor->setServerData($data);

        $this->entityManager->persist($visitor);
        $this->entityManager->flush();
        return $visitor->getPublicID();
    }

    /**
     * Save the model
     *
     * @param Model\Visitor $visitor
     * @return $this
     */
    public function save(Model\Visitor $visitor)
    {
        $this->entityManager->persist($visitor);
        $this->entityManager->flush();
        return $this;
    }

    /**
     * Get one for the public ID
     *
     * @return Model\Visitor
     * @param $id
     */
    public function findByPublicID($id)
    {
        return $this->entityManager->getRepository('AboutBrowser\Model\Visitor')->findOneByPublicId($id);
    }
}