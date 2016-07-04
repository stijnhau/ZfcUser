<?php
namespace ZfcUser\Factory\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\View\Helper\ZfcUserIdentity;

class IdentityFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        /* @var $authService AuthenticationService */
        $authService = $serviceLocator->get('zfcuser_auth_service');

        $viewHelper = new ZfcUserIdentity;
        $viewHelper->setAuthService($authService);

        return $viewHelper;
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

        $this->__invoke($serviceLocator, "Identity");
    }
}
