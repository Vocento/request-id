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
namespace Vocento\Exception;

/**
 * @author Ariel Ferrandini <aferrandini@vocento.com>
 */
class EmptyRequestIdException extends \RuntimeException
{
    /**
     * EmptyRequestIdException constructor.
     * @param \Exception|null $previous
     */
    public function __construct(\Exception $previous = null)
    {
        parent::__construct('Empty request id', null, $previous);
    }
}
