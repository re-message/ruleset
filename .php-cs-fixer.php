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

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->append([__FILE__])
    ->exclude('vendor')
;

$namespace = 'Re Message';
$projectTitle = 'the Re Message PHP CS Fixer rule set';
$projectName = 'ruleset';

$header = <<<EOF
    This file is part of {$projectTitle}.

    (c) 2018-present {$namespace}
        Oleg Kozlov <h1karo@remessage.ru>

    For the full copyright and license information, please view the LICENSE
    file that was distributed with this source code.

    https://dev.remessage.ru/packages/{$projectName}
    https://github.com/re-message/{$projectName}
    EOF;

$config = new RM\Style\RuleSet\Config();

return $config
    ->setHeader($header)
    ->setFinder($finder)
;
