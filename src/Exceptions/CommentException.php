<?php

namespace Cyberfusion\PowerDNS\Exceptions;

use Throwable;

class CommentException extends PowerDNSException
{
    public static function accountLengthExceeded(Throwable $previous = null): self
    {
        return new self(
            message: 'The account name is too long. It can be a maximum of 40 characters long.',
            previous: $previous,
        );
    }
}
