<?php
namespace ZfcUser\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\Hydrator;
use ZfcUser\Mapper;
use ZfcUser\Options;

class UserMapperFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        /* @var $options Options\ModuleOptions */
        $options = $serviceLocator->get('zfcuser_module_options');

        /* @var $dbAdapter Db\Adapter\Adapter */
        $dbAdapter = $serviceLocator->get('zfcuser_zend_db_adapter');

        /** @todo change harcoded table to an module_option */
        $mapper = new Mapper\User('user', $dbAdapter);

        $entityClass = $options->getUserEntityClass();

        /* @var $hydrator Hydrator\HydratorInterface */
        $hydrator = $serviceLocator->get('zfcuser_user_hydrator');

        $mapper
            ->setEntityPrototype(new $entityClass)
            ->setHydrator($hydrator)
            ->setTableName($options->getTableName())
        ;

        return $mapper;
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
