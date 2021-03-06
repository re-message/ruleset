<?php
/*
 * This file is a part of Re Message PHP CS Fixer rule set.
 * This package is a part of Re Message.
 *
 * @link      https://github.com/re-message/ruleset
 * @link      https://dev.remessage.ru/packages/ruleset
 * @copyright Copyright (c) 2018-2022 Re Message
 * @author    Oleg Kozlov <h1karo@remessage.ru>
 * @license   Apache License 2.0
 * @license   https://legal.remessage.ru/licenses/ruleset
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace RM\Style\RuleSet;

use PhpCsFixer\Config as ParentConfig;

class Config extends ParentConfig
{
    private ?string $header = null;

    public function __construct()
    {
        parent::__construct('remessage');

        // remove default rules
        $this->setRules([]);
        $this->setRiskyAllowed(true);
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
            '@PSR12' => true,
            '@PhpCsFixer' => true,
            '@Symfony' => true,
            '@DoctrineAnnotation' => true,
            '@PHP80Migration:risky' => true,
            '@PHP81Migration' => true,
            'ordered_imports' => [
                'sort_algorithm' => 'alpha',
                'imports_order' => ['class', 'function', 'const'],
            ],
            'declare_strict_types' => false,
            'ordered_class_elements' => false,
            'no_superfluous_phpdoc_tags' => false,
            'strict_param' => true,
            'array_syntax' => ['syntax' => 'short'],
            'concat_space' => ['spacing' => 'one'],
            'php_unit_fqcn_annotation' => false,
            'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
            'phpdoc_tag_type' => [
                'tags' => ['inheritDoc' => 'annotation'],
            ],
            'phpdoc_tag_casing' => [
                'tags' => ['inheritDoc'],
            ],
            'phpdoc_to_comment' => [
                'ignored_tags' => ['todo', 'noinspection', 'psalm-suppress'],
            ],
        ];
    }

    protected function getHeaderRules(): array
    {
        if (null === $this->header) {
            return [];
        }

        return [
            'header_comment' => [
                'header' => $this->header,
                'comment_type' => 'comment',
                'location' => 'after_open',
                'separate' => 'bottom',
            ],
        ];
    }

    public function setHeader(?string $header): static
    {
        $this->header = $header;

        return $this;
    }
}
