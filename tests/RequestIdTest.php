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

declare(strict_types=1);

namespace Vocento\Tests;

use PHPUnit\Framework\TestCase;
use Vocento\Exception\EmptyRequestIdException;
use Vocento\RequestId;

/**
 * @author Ariel Ferrandini <aferrandini@vocento.com>
 * @author Hugo Santiago Becerra Adán <hsbecerra@vocento.com>
 *
 * @covers \Vocento\RequestId
 *
 * @internal
 */
final class RequestIdTest extends TestCase
{
    public function testCreateDefaultId(): void
    {
        $requestId = RequestId::create();

        self::assertMatchesRegularExpression(
            '/^\d+.\d+-[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/',
            $requestId->getId()
        );
    }

    public function testNoRepeatedRequestId(): void
    {
        $requestIds = [];

        for ($i = 0; $i < 100; ++$i) {
            $requestId = RequestId::create();

            self::assertNotContains($requestId->getId(), $requestIds);

            $requestIds[] = $requestId->getId();
        }
    }

    public function testCreateWithId(): void
    {
        $id = 'request.id.test';
        $requestId = RequestId::create($id);

        self::assertSame($id, $requestId->getId());
    }

    public function testExceptionCreatingEmptyRequestId(): void
    {
        $this->expectException(EmptyRequestIdException::class);
        RequestId::create('');
    }

    public function testGetHeaderName(): void
    {
        $requestId = RequestId::create();

        self::assertSame(RequestId::HEADER_NAME, $requestId->getHeaderName());
    }

    public function testCastingToStringShouldReturnString(): void
    {
        $requestId = RequestId::create();

        self::assertSame($requestId->getId(), (string) $requestId);
    }
}
