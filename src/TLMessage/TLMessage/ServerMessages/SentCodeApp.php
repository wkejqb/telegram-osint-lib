<?php


namespace TLMessage\TLMessage\ServerMessages;


use MTSerialization\AnonymousMessage;
use TLMessage\TLMessage\TLServerMessage;


class SentCodeApp extends TLServerMessage
{

    /**
     * @param AnonymousMessage $tlMessage
     * @return boolean
     */
    public static function isIt(AnonymousMessage $tlMessage)
    {
        return self::checkType($tlMessage, 'auth.sentCode');
    }


    /**
     * @return boolean
     */
    public function isSentCodeTypeSms()
    {
        return $this->getTlMessage()->getNode('type')->getType() == 'auth.sentCodeTypeSms';
    }


    /**
     * @return string
     */
    public function getPhoneCodeHash()
    {
        return $this->getTlMessage()->getValue('phone_code_hash');
    }

}