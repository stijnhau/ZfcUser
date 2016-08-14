<?php
namespace ZfcUserTest\Factory\Form;

use Zend\ServiceManager\ServiceManager;
use ZfcUser\Factory\Form\RegisterFormFactory;
use ZfcUser\Options\ModuleOptions;

class RegisterFormFactoryTest extends \PHPUnit_Framework_TestCase
{
    public function testFactory()
    {
        $mapper = $this->getMock('ZfcUser\Mapper\UserInterface');

        $serviceManager = new ServiceManager;
        $serviceManager->setService('zfcuser_module_options', new ModuleOptions);
        $serviceManager->setService('zfcuser_user_mapper', $mapper);

        $factory = new RegisterFormFactory;

        $this->assertInstanceOf('ZfcUser\Form\Register', $factory->createService($serviceManager));
    }
}
