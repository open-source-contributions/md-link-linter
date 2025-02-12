<?php

declare(strict_types=1);

/*
 * This file is part of the Markdown Link Linter library.
 *
 * (c) Norbert Orzechowicz <contact@norbert.tech>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MDLinkLinter\Tests\Assertion;

use MDLinkLinter\Assertion\MentionLink;
use MDLinkLinter\Exception\AssertionException;
use MDLinkLinter\Tests\Mother\LinkMotherObject;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;

final class MentionLinkTest extends TestCase
{
    public function test_do_nothing_when_whitelist_is_empty() : void
    {
        $assertion = new MentionLink(LinkMotherObject::mention('norzechowicz'), []);

        $this->assertTrue(true);
    }

    public function test_assertion_when_mention_not_on_whitelist() : void
    {
        $this->expectException(AssertionException::class);

        (new MentionLink(LinkMotherObject::mention('test'), ['norzechowicz']))->assert(new NullLogger());
    }

    public function test_assertion_not_case_sensitive() : void
    {
        $assertion = new MentionLink(LinkMotherObject::mention('NorzechowiCZ'), ['Norzechowicz']);

        $this->assertTrue(true);
    }
}
