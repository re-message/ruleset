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

use PhpCsFixer\Finder;
use PhpCsFixer\Runner\Parallel\ParallelConfigFactory;
use RM\Style\RuleSet\Config;
use RM\Style\RuleSet\Header;

$finder = Finder::create()
    ->in(__DIR__)
    ->append([__FILE__])
    ->exclude('vendor')
;

$header = new Header()
    ->setNamespace('Re Message')
    ->setProjectName('ruleset')
    ->setProjectTitle('the Re Message PHP CS Fixer rule set')
    ->withAuthor('Oleg Kozlov', 'h1karo@remessage.ru')
;

return new Config()
    ->setHeader($header)
    ->setFinder($finder)
    ->setParallelConfig(ParallelConfigFactory::detect())
;
