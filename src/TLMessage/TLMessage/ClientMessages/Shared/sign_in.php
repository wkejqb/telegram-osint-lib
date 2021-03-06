<?php

namespace TLMessage\TLMessage\ClientMessages\Shared;

use TLMessage\TLMessage\Packer;
use TLMessage\TLMessage\TLClientMessage;

/**
 * @see https://core.telegram.org/method/auth.signIn
 */
class sign_in implements TLClientMessage
{

    const CONSTRUCTOR = -1126886015; // 0xbcd51581


    /**
     * @var string
     */
    private $phone;
    /**
     * @var string
     */
    private $phoneHash;
    /**
     * @var string
     */
    private $smsCode;


    /**
     * sign_in constructor.
     * @param string $phone
     * @param string $phoneHash
     * @param string $smsCode
     */
    public function __construct(string $phone, string $phoneHash, string $smsCode)
    {
        $this->phone = $phone;
        $this->phoneHash = $phoneHash;
        $this->smsCode = $smsCode;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'sign_in';
    }


    /**
     * @return string
     */
    public function toBinary()
    {
        return
            Packer::packConstructor(self::CONSTRUCTOR).
            Packer::packString($this->phone).
            Packer::packString($this->phoneHash).
            Packer::packString($this->smsCode);
    }

}