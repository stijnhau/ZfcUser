<?php
namespace ZfcUser\Factory\Mapper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\Mapper\User;

class UserMapperFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        /** @var $table \Zend\Db\TableGateway\AbstractTableGateway */
        $table = $serviceLocator->get('zfcuser_user_tablegateway');

        /* @var $hydrator \Zend\Hydrator\HydratorInterface */
        $hydrator = $serviceLocator->get('zfcuser_user_hydrator');

        return new User($table, $hydrator);
    }

    /**
     * @deprecated ZF2 compability.
     *
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /* @var ServiceLocatorInterface $serviceLocator */
        $serviceLocator = $serviceLocator->getServiceLocator();

        $this->__invoke($serviceLocator, "UserMapper");
    }
}
