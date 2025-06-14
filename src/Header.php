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

class Header implements Stringable
{
    private string $namespace;

    private string $projectName;

    private string $projectTitle;

    /**
     * @var Author[]
     */
    private array $authors = [];

    public function setNamespace(string $namespace): self
    {
        $this->namespace = $namespace;

        return $this;
    }

    public function setProjectName(string $projectName): self
    {
        $this->projectName = $projectName;

        return $this;
    }

    public function setProjectTitle(string $projectTitle): self
    {
        $this->projectTitle = $projectTitle;

        return $this;
    }

    public function withAuthor(string $name, ?string $email = null): self
    {
        $this->authors[] = new Author($name, $email);

        return $this;
    }

    private function getAuthors(): string
    {
        $indent = fn(string $value) => str_repeat(' ', 4) . $value;

        return implode(PHP_EOL, array_map($indent, $this->authors));
    }

    #[Override]
    public function __toString(): string
    {
        return <<<EOF
            This file is part of {$this->projectTitle}.

            (c) 2018-present {$this->namespace}
            {$this->getAuthors()}

            For the full copyright and license information, please view the LICENSE
            file that was distributed with this source code.

            https://dev.remessage.ru/packages/{$this->projectName}
            https://github.com/re-message/{$this->projectName}
            EOF;
    }
}
