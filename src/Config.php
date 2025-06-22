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

use PhpCsFixer\Config as ParentConfig;

class Config extends ParentConfig
{
    private ?Header $header = null;

    public function __construct()
    {
        parent::__construct('remessage');

        // remove default rules
        $this->setRules([]);
        $this->setRiskyAllowed(true);
        $this->registerCustomFixers([new NoDebugStatement()]);
    }

    public function getRules(): array
    {
        return array_merge(
            $this->getDefaultRules(),
            $this->getHeaderRules(),
            parent::getRules(),
        );
    }

    protected function getDefaultRules(): array
    {
        return [
            '@PhpCsFixer' => true,
            '@Symfony' => true,
            '@PER-CS' => true,
            '@PER-CS:risky' => true,
            '@PHP82Migration:risky' => true,
            '@PHP84Migration' => true,
            'global_namespace_import' => [
                'import_classes' => true,
                'import_constants' => true,
                'import_functions' => true,
            ],
            'ordered_imports' => [
                'sort_algorithm' => 'alpha',
                'imports_order' => ['class', 'function', 'const'],
            ],
            'ordered_types' => [
                'sort_algorithm' => 'none',
                'null_adjustment' => 'always_last',
            ],
            'declare_strict_types' => false,
            'strict_param' => true,
            'blank_line_after_opening_tag' => true,
            'php_unit_test_class_requires_covers' => false,
            'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
            'phpdoc_to_comment' => [
                'ignored_tags' => ['todo', 'noinspection', 'psalm-suppress'],
            ],
            'phpdoc_types_order' => [
                'sort_algorithm' => 'alpha',
                'null_adjustment' => 'always_last',
            ],
            NoDebugStatement::NAME => true,
        ];
    }

    protected function getHeaderRules(): array
    {
        if (null === $this->header) {
            return [];
        }

        return [
            'header_comment' => [
                'header' => (string) $this->header,
                'comment_type' => 'comment',
                'location' => 'after_open',
                'separate' => 'bottom',
            ],
        ];
    }

    public function setHeader(Header $header): static
    {
        $this->header = $header;

        return $this;
    }
}
