<?php

namespace TLMessage\TLMessage\ServerMessages;


use MTSerialization\AnonymousMessage;
use TLMessage\TLMessage\TLServerMessage;


class DcConfigApp extends TLServerMessage
{

    /**
     * @param AnonymousMessage $tlMessage
     * @return boolean
     */
    public static function isIt(AnonymousMessage $tlMessage)
    {
        return self::checkType($tlMessage, 'config');
    }


    /**
     * @return DcOption[]
     * @noinspection PhpDocMissingThrowsInspection
     * @noinspection PhpUnhandledExceptionInspection
     */
    public function getDataCenters()
    {
        $dcs = $this->getTlMessage()->getNodes('dc_options');

        $dcObjects = [];
        foreach ($dcs as $dc)
            $dcObjects[] = new DcOption($dc);

        return $dcObjects;
    }


    /**
     * @return int
     * @noinspection PhpUnused
     */
    public function getLangPackVersion()
    {
        return (int)$this->getTlMessage()->getValue('lang_pack_version');
    }



}