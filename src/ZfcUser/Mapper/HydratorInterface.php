<?php
namespace ZfcUser\Mapper;

use Zend\Hydrator\HydratorInterface as ZendHydrator;

interface HydratorInterface extends ZendHydrator
{
    /**
     * @return ZendCryptPassword
     */
    public function getCryptoService();
}
