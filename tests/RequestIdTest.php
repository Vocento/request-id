<?php
/*
 * This file is part of the Vocento Software.
 *
 * (c) Vocento S.A., <desarrollo.dts@vocento.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

namespace Vocento\Tests;

use Vocento\Exception\EmptyRequestIdException;
use Vocento\RequestId;

/**
 * @author Ariel Ferrandini <aferrandini@vocento.com>
 */
class RequestIdTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function testCreate()
    {
        $requestId = RequestId::create();
        $this->assertInstanceOf('Vocento\RequestId', $requestId);
    }

    /**
     * @test
     */
    public function noRepeatedRequestId()
    {
        $requestIds = [];

        for ($i = 0; $i<100; $i++) {
            $requestId = RequestId::create();
            $this->assertFalse(array_key_exists($requestId->getId(), $requestIds));
            $requestIds[$requestId->getId()] = true;
        }
    }

    /**
     * @test
     */
    public function testCreateWithId()
    {
        $id = 'request.id.test';
        $requestId = RequestId::create($id);
        $this->assertInstanceOf('Vocento\RequestId', $requestId);
        $this->assertEquals($id, $requestId->getId());
    }

    /**
     * @test
     */
    public function testExceptionCreatingEmptyRequestId()
    {
        $this->expectException(EmptyRequestIdException::class);
        RequestId::create('');
    }

    /**
     * @test
     */
    public function testGetHeaderName()
    {
        $requestId = RequestId::create();
        $this->assertEquals(RequestId::HEADER_NAME, $requestId->getHeaderName());
    }

    /**
     * @test
     */
    public function testCastingToStringShouldReturnString()
    {
        $requestId = RequestId::create();
        $this->assertInternalType('string', (string)$requestId);
    }
}
