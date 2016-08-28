<?php

namespace ZfcUser\Mapper;

use Zend\Db\TableGateway\TableGateway as TableGateway;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\Hydrator\HydratorInterface as Hydrator;
use ZfcUser\EventManager\EventProvider;
use ZfcUser\Entity\User as Entity;

class User extends TableGateway implements UserInterface, EventManagerAwareInterface
{
    use EventProvider;

    private $hydrator;

    /**
     * @return the $hydrator
     */
    public function getHydrator()
    {
        return $this->hydrator;
    }

    /**
     * @param field_type $hydrator
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
    }

    public function findByEmail($email)
    {
        $data = $this->select(array('email' => $email))->current();
        /** @todo use the one from de config file */
        $entity = $this->hydrator->hydrate($data->getArrayCopy(), new Entity());

        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function findByUsername($username)
    {
        $data = $this->select(array('username' => $username))->current();
        /** @todo use the one from de config file */
        $entity = $this->hydrator->hydrate($data->getArrayCopy(), new Entity());

        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function findById($id)
    {
        $data = $this->select(array('id' => $id))->current();
        /** @todo use the one from de config file */
        $entity = $this->hydrator->hydrate($data->getArrayCopy(), new Entity());

        $this->getEventManager()->trigger('find', $this, array('entity' => $entity));
        return $entity;
    }

    public function insert($entity)
    {
        $data = $this->hydrator->extract($entity);

        $result = parent::insert($data);
        return $result;
    }

    public function update($entity, $where = null)
    {
        if (!$where) {
            $where = array('id' => $entity->getId());
        }
        $data = $this->hydrator->extract($entity);

        return parent::update($data, $where);
    }
}
