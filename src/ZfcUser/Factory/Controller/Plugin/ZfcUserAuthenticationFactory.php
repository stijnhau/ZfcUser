<?php
namespace ZfcUser\Factory\Controller\Plugin;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\Authentication\Adapter;
use ZfcUser\Controller\Plugin\ZfcUserAuthentication;

class ZfcUserAuthenticationFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $serviceManager, $requestedName, array $options = null)
    {
        /* @var $authService AuthenticationService */
        $authService = $serviceManager->get('zfcuser_auth_service');

        /* @var $authAdapter Adapter\AdapterChain */
        $authAdapter = $serviceManager->get('ZfcUser\Authentication\Adapter\AdapterChain');

        $controllerPlugin = new ZfcUserAuthentication;
        $controllerPlugin
            ->setAuthService($authService)
            ->setAuthAdapter($authAdapter)
        ;

        return $controllerPlugin;
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

        $this->__invoke($serviceLocator, "ZfcUserAuthentication");
    }
}
