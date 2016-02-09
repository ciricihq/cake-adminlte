<?php
namespace Cirici\AdminLTE\Test\TestCase;

use ReflectionClass;

/**
 * ProtectedAccessorTrait declares getProtectedProperty and runProtectedMethod
 * so you can easily get/invoke protected properties and methods.
 *
 * @author Òscar Casajuana <elboletaire@underave.net>
 */
trait ProtectedAccessorTrait
{
    /**
     * Returns a protected property, for tests.
     *
     * @param  object $obj  The class instance object.
     * @param  string $name The property name to be returned.
     * @return mixed
     * @coversNothing
     */
    private function getProtectedProperty($object, $name)
    {
        $class = new ReflectionClass(get_class($object));
        $property = $class->getProperty($name);
        $property->setAccessible(true);

        return $property->getValue($this->renderer);
    }

    /**
     * Runs a protected method, for tests.
     *
     * @param  object $obj  The class instance object.
     * @param  string $name The method name to be run.
     * @param  array  $args The arguments passed to the method, as an array.
     * @return mixed
     * @coversNothing
     */
    private function runProtectedMethod($object, $name, $args = [])
    {
        $class = new ReflectionClass(get_class($object));
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $args);
    }
}
