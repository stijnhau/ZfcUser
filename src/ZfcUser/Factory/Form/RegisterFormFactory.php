<?php
namespace ZfcUser\Factory\Form;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcUser\Form\Register;
use ZfcUser\Form\RegisterFilter;
use ZfcUser\Options;
use ZfcUser\Validator\NoRecordExists;

class RegisterFormFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $serviceLocator, $requestedName, array $options = null)
    {
        /* @var $options Options\ModuleOptions */
        $options = $serviceLocator->get('zfcuser_module_options');

        $userMapper = $serviceLocator->get('zfcuser_user_mapper');

        $emailValidator = new NoRecordExists(array(
            'mapper' => $userMapper,
            'key' => 'email',
        ));

        $userNameValidator = new NoRecordExists(array(
            'mapper' => $userMapper,
            'key' => 'username',
        ));

        $inputFilter = new RegisterFilter(
            $emailValidator,
            $userNameValidator,
            $options
        );

        $form = new Register(null, $options);
        // $form->setCaptchaElement($sm->get('zfcuser_captcha_element'));
        $form->setInputFilter($inputFilter);

        return $form;
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

        $this->__invoke($serviceLocator, "RegisterForm");
    }
}
