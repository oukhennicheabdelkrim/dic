<?php


namespace oukhennicheabdelkrim\DIC\tests\containerTests;


use oukhennicheabdelkrim\DIC\Definition\CacheInstance;
use PHPUnit\Framework\TestCase;

class CacheInstanceTest extends TestCase
{
    public function testHasMethod()
    {
        $cacheInstance = new CacheInstance();
        $this->assertFalse($cacheInstance->has('a'));
        $cacheInstance->put('a', 1);
        $this->assertTrue($cacheInstance->has('a'));
        $cacheInstance->remove('a');
        $this->assertFalse($cacheInstance->has('a'));
    }

    public function testGetMethod()
    {
        $cacheInstance = new CacheInstance();
        $this->assertNull($cacheInstance->get('a'));
        $cacheInstance->put('cache.instance', $cacheInstance);
        $this->assertEquals($cacheInstance, $cacheInstance->get('cache.instance'));

    }
}
