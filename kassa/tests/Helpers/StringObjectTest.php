<?php

namespace Tests\YandexCheckout\Helpers;

use PHPUnit\Framework\TestCase;
use YandexCheckout\Helpers\StringObject;

class StringObjectTest extends TestCase
{
    /**
     * @dataProvider dataProvider
     * @param string $value
     */
    public function testToString($value)
    {
        $instance = new StringObject($value);
        self::assertEquals($value, $instance->__toString());
    }

    public function dataProvider()
    {
        return array(
            array(''),
            array('value'),
        );
    }
}