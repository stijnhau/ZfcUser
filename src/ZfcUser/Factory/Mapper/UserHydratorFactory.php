<?php
namespace ZfcUser\Factory\Mapper;

use Zend\Crypt\Password\Bcrypt;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\Mapper;
use Interop\Container\ContainerInterface;

class UserHydratorFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        $options = $serviceLocator->get('zfcuser_module_options');
        $crypto  = new Bcrypt;
        $crypto->setCost($options->getPasswordCost());
        return new Mapper\UserHydrator($crypto);
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

        $this->__invoke($serviceLocator, "UserHydrator");
    }
}
