<?php

namespace MTSerialization\OwnImplementation;


use Exception\TGException;
use MTSerialization\AnonymousMessage;

class OwnAnonymousMessage implements AnonymousMessage
{

    /**
     * @var array
     */
    private $object;


    /**
     * OwnAnonymousMessage constructor.
     * @param array $deserializedByOwnArray
     * @throws TGException
     */
    public function __construct(array $deserializedByOwnArray)
    {
        if(!is_array($deserializedByOwnArray))
            throw new TGException(TGException::ERR_TL_MESSAGE_FIELD_BAD_NODE);

        $this->object = $deserializedByOwnArray;
    }


    /**
     * Return named node from current object
     *
     * @param string $name
     * @return AnonymousMessage
     * @throws TGException
     */
    public function getNode(string $name)
    {
        $node = $this->getValue($name);
        if(!is_array($node))
            throw new TGException(TGException::ERR_TL_MESSAGE_FIELD_BAD_NODE);

        return new OwnAnonymousMessage($node);
    }


    /**
     * Return array of nodes under the $name from current object
     *
     * @param string $name
     * @return AnonymousMessage[]
     * @throws TGException
     */
    public function getNodes(string $name)
    {
        $nodes = $this->getValue($name);
        if(!is_array($nodes))
            throw new TGException(TGException::ERR_TL_MESSAGE_FIELD_BAD_NODE);

        $objects = [];
        foreach ($nodes as $node)
            $objects[] = new OwnAnonymousMessage($node);

        return $objects;
    }


    /**
     * Get message name
     *
     * @return string
     */
    public function getType()
    {
        return isset($this->object['_']) ? $this->object['_'] : null;
    }


    /**
     * Get value of named field from current object
     *
     * @param string $name
     * @return int|string|array
     * @throws TGException
     */
    public function getValue(string $name)
    {
        if(!array_key_exists($name, $this->object))
            throw new TGException(TGException::ERR_TL_MESSAGE_FIELD_NOT_EXISTS);

        return $this->object[$name];
    }


    public function __toString()
    {
        return $this->getDebugPrintable();
    }


    /**
     * @return string
     */
    public function getPrintable()
    {
        return json_encode($this->object, JSON_PRETTY_PRINT);
    }


    /**
     * @return string
     */
    public function getDebugPrintable()
    {
        return print_r($this->object, true);
    }

}