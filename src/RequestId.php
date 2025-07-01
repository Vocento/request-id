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

namespace Vocento;

use Ramsey\Uuid\Uuid;
use Vocento\Exception\EmptyRequestIdException;

/**
 * @author Ariel Ferrandini <aferrandini@vocento.com>
 * @author Hugo Santiago Becerra Adán <hsbecerra@vocento.com>
 */
final class RequestId
{
    public const HEADER_NAME = 'request-id';

    private string $id;

    private function __construct(string $id)
    {
        if ('' === $id) {
            throw new EmptyRequestIdException();
        }

        $this->id = $id;
    }

    public static function create(?string $id = null): self
    {
        if (null === $id) {
            $microtime = (string) \microtime(true);

            /** @var string $time */
            $time = \str_replace('.', '-', $microtime);

            $id = \sprintf('%s-%s', $time, Uuid::uuid4()->toString());
        }

        return new self($id);
    }

    public function getHeaderName(): string
    {
        return self::HEADER_NAME;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function __toString(): string
    {
        return $this->id;
    }
}
