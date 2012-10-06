<?php

namespace Dissect\Parser\Exception;

use Dissect\Lexer\Token;
use RuntimeException;

/**
 * Thrown when a parser encounters an unexpected token.
 *
 * @author Jakub Lédl <jakubledl@gmail.com>
 */
class UnexpectedTokenException extends RuntimeException
{
    const MESSAGE = <<<EOT
Unexpected %s at line %d, position %d.

Expected one of %s.
EOT;

    /**
     * @var \Dissect\Lexer\Token
     */
    protected $token;

    /**
     * @var string[]
     */
    protected $expected;

    /**
     * Constructor.
     *
     * @param \Dissect\Lexer\Token $token The unexpected token.
     * @param string[] $expected The expected token types.
     */
    public function __construct(Token $token, array $expected)
    {
        $this->token = $token;
        $this->expected = $expected;

        parent::__construct(sprintf(
            self::MESSAGE,
            $token->getType(),
            $token->getLine(),
            $token->getOffset(),
            implode(', ', $expected)
        ));
    }

    /**
     * Returns the unexpected token.
     *
     * @return \Dissect\Lexer\Token The unexpected token.
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * Returns the expected token types.
     *
     * @return string[] The expected token types.
     */
    public function getExpected()
    {
        return $this->expected;
    }
}