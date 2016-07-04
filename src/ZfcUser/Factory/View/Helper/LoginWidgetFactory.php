<?php
namespace ZfcUser\Factory\View\Helper;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\Options;
use ZfcUser\View\Helper\ZfcUserLoginWidget;

class LoginWidgetFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        /* @var $options Options\ModuleOptions */
        $options = $serviceLocator->get('zfcuser_module_options');
        $viewTemplate = $options->getUserLoginWidgetViewTemplate();

        /* @var $loginForm Form\Login */
        $loginForm = $serviceLocator->get('zfcuser_login_form');

        $viewHelper = new ZfcUserLoginWidget;
        $viewHelper
            ->setViewTemplate($viewTemplate)
            ->setLoginForm($loginForm)
        ;

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

        $this->__invoke($serviceLocator, "LoginWidget");
    }
}
