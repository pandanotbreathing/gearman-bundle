<?php

namespace Horrible\GearmanBundle\Tests\Base;

use Symfony\Bundle\FrameworkBundle\Client;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit_Framework_MockObject_MockObject as Mock;

abstract class BaseTest extends WebTestCase
{
    /**
     * @var Client
     */
    protected $client;

    /**
     * Init client
     */
    protected function initClient()
    {
        $this->client = static::createClient();
    }

    /**
     * getPrivateMethod.
     *
     * @param string|object $class
     * @param string        $method
     *
     * @return \ReflectionMethod
     */
    protected function getPrivateMethod($class, $method)
    {
        $class = is_string($class) ? $class : get_class($class);
        $reflector = new \ReflectionClass($class);
        $method = $reflector->getMethod($method);
        $method->setAccessible(true);

        return $method;
    }

    /**
     * getPrivateProperty.
     *
     * @param string|object $class
     * @param string        $property
     *
     * @return \ReflectionProperty
     */
    protected function getPrivateProperty($class, $property)
    {
        $class = is_string($class) ? $class : get_class($class);
        $reflector = new \ReflectionClass($class);
        if (!$reflector->hasProperty($property) &&
            $reflector->getParentClass() &&
            $reflector->getParentClass()->hasProperty($property)
        ) {
            $reflector = $reflector->getParentClass();
        }
        $property = $reflector->getProperty($property);
        $property->setAccessible(true);

        return $property;
    }

    /**
     * setPrivateProperty.
     *
     * @param object $class
     * @param string $property
     * @param mixed  $value
     */
    protected function setPrivateProperty($class, $property, $value)
    {
        $property = $this->getPrivateProperty($class, $property);
        $property->setValue($class, $value);
    }

    /**
     * @param $className
     * @param array $methods
     * @return Mock
     */
    protected function getClassMock($className, array $methods = [])
    {
        return $this->getMockBuilder($className)
            ->disableOriginalConstructor()
            ->setMethods($methods)
            ->getMock();
    }
}
