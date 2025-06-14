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
use PhpCsFixer\AbstractFunctionReferenceFixer;
use PhpCsFixer\FixerDefinition\CodeSample;
use PhpCsFixer\FixerDefinition\FixerDefinition;
use PhpCsFixer\FixerDefinition\FixerDefinitionInterface;
use PhpCsFixer\Tokenizer\Tokens;
use SplFileInfo;

use const T_FUNCTION;
use const T_NEW;
use const T_STRING;

final class NoDebugStatement extends AbstractFunctionReferenceFixer
{
    public const string NAME = 'ReMessage/no_dump_statement';

    private const array FUNCTIONS = ['dump', 'var_dump', 'dd'];

    #[Override]
    public function isCandidate(Tokens $tokens): bool
    {
        return $tokens->isTokenKindFound(T_STRING);
    }

    #[Override]
    public function getName(): string
    {
        return self::NAME;
    }

    #[Override]
    public function getDefinition(): FixerDefinitionInterface
    {
        return new FixerDefinition(
            'Removes dump/var_dump statements, which shouldn\'t be in production ever.',
            [new CodeSample("<?php\nvar_dump(false);\n")],
            null,
            'Risky when functions ' . implode(', ', self::FUNCTIONS) . ' are redefined.',
        );
    }

    #[Override]
    protected function applyFix(SplFileInfo $file, Tokens $tokens): void
    {
        foreach (self::FUNCTIONS as $function) {
            $currIndex = 0;
            while (null !== $currIndex) {
                $matches = $this->find($function, $tokens, $currIndex);
                if (null === $matches) {
                    break;
                }

                [$functionNameIndex, $openParenthesis] = $matches;
                $currIndex = $openParenthesis;

                $funcStart = $tokens->getPrevNonWhitespace($functionNameIndex);

                if ($tokens[$funcStart]->isGivenKind(T_NEW) || $tokens[$funcStart]->isGivenKind(T_FUNCTION)) {
                    break;
                }

                $funcEnd = $tokens->getNextTokenOfKind($openParenthesis, [';']);

                $tokens->clearRange($funcStart + 1, $funcEnd);
            }
        }
    }
}
