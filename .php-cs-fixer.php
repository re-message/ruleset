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

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->append([__FILE__])
    ->exclude('vendor')
;

$namespace = 'Re Message';
$projectTitle = 'Re Message PHP CS Fixer rule set';
$projectName = 'ruleset';
$currentYear = date('Y');

$header = <<<EOF
    This file is a part of {$projectTitle}.
    This package is a part of {$namespace}.

    @link      https://github.com/re-message/{$projectName}
    @link      https://dev.remessage.ru/packages/{$projectName}
    @copyright Copyright (c) 2018-{$currentYear} {$namespace}
    @author    Oleg Kozlov <h1karo@remessage.ru>
    @license   Apache License 2.0
    @license   https://legal.remessage.ru/licenses/{$projectName}

    For the full copyright and license information, please view the LICENSE
    file that was distributed with this source code.
    EOF;

$config = new RM\Style\RuleSet\Config();

return $config
    ->setHeader($header)
    ->setFinder($finder)
;
