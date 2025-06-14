<?php

/*
 * This file is part of the Re Message PHP CS Fixer rule set.
 *
 * (c) 2018-present Re Message
 *     Oleg Kozlov <h1karo@remessage.ru>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * https://dev.remessage.ru/packages/ruleset
 * https://github.com/re-message/ruleset
 */

namespace RM\Style\RuleSet;

use Override;
use Stringable;

final readonly class Author implements Stringable
{
    public function __construct(
        public string $name,
        public ?string $email = null,
    ) {
    }

    #[Override]
    public function __toString(): string
    {
        return "{$this->name} <{$this->email}>";
    }
}
