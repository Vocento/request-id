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

namespace Vocento\Exception;

/**
 * @author Ariel Ferrandini <aferrandini@vocento.com>
 * @author Hugo Santiago Becerra Adán <hsbecerra@vocento.com>
 */
class EmptyRequestIdException extends \RuntimeException
{
    /**
     * EmptyRequestIdException constructor.
     */
    public function __construct(?\Exception $previous = null)
    {
        parent::__construct('Empty request id', 0, $previous);
    }
}
