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
        /* @var $dbAdapter Db\Adapter\Adapter */
        $dbAdapter = $serviceLocator->get('zfcuser_zend_db_adapter');

        return new User($options->getTableName(), $dbAdapter);
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

        return $this->__invoke($serviceLocator, "UserMapper");
    }
}
