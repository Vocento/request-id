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
namespace Vocento;

use Ramsey\Uuid\Uuid;
use Vocento\Exception\EmptyRequestIdException;

/**
 * @author Ariel Ferrandini <aferrandini@vocento.com>
 */
final class RequestId
{
    const HEADER_NAME = 'request-id';

    /** @var string */
    protected $id;

    /**
     * RequestId constructor.
     * @param $id
     */
    private function __construct($id)
    {
        if (empty($id)) {
            throw new EmptyRequestIdException();
        }

        $this->id = (string)$id;
    }

    /**
     * @param null $id
     * @return RequestId
     */
    public static function create($id = null)
    {
        $class = __CLASS__;

        if (null === $id) {
            $id = str_replace('.','-',microtime(true)).'-'.Uuid::uuid4()->toString();
        }

        return new $class($id);
    }

    /**
     * @return string
     */
    public function getHeaderName()
    {
        return self::HEADER_NAME;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }
}
