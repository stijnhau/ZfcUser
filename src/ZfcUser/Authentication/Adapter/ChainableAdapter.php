<?php

namespace ZfcUser\Authentication\Adapter;

use Zend\EventManager\Event;

interface ChainableAdapter
{
    public function authenticate(Event $e);
}
