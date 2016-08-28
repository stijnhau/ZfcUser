<?php
namespace ZfcUser\Factory\Authentication\Adapter;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\Authentication\Adapter\Db as adapter;

class Db implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        $db = new adapter();
        $db->setServiceManager($serviceLocator);

        return $db;
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

        $this->__invoke($serviceLocator, "Db");
    }
}
