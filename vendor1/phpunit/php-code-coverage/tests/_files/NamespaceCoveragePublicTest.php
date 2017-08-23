<?php
class NamespaceCoveragePublicTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers Foo\CoveredClass::<storage>
     */
    public function testSomething()
    {
        $o = new Foo\CoveredClass;
        $o->publicMethod();
    }
}
