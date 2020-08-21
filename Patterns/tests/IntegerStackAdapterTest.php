<?php
declare(strict_types = 1);

use PHPUnit\Framework\TestCase;
use src\Adapter\ASCIIStackInterface;
use src\Adapter\IntegerStackAdapter;

class IntegerStackAdapterTest extends TestCase
{
    public function testPush(): void
    {
        $stringStackMock = $this->createMock(ASCIIStackInterface::class);

        $stringStackMock
            ->method('push')
            ->with($this->equalTo('1233'));

        $stringStackMock
            ->method('pop')
            ->willReturn('1233');

        $adapter = new IntegerStackAdapter($stringStackMock);
        $adapter->push(1233);
        $this->assertEquals(1233, $adapter->pop());
    }
}
