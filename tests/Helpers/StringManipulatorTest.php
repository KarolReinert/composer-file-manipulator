<?php

namespace Reinert\ComposerFileManipulator\Tests\Helpers;


use PHPUnit\Framework\TestCase;
use Reinert\ComposerFileManipulator\Helpers\StringManipulator;

/**
 * Class StringManipulatorTest
 * @package Reinert\ComposerFileManipulator\Tests
 */
class StringManipulatorTest extends TestCase
{
    public function test_get_between(): void
    {
        $string = 'test test [CUSTOM START] config.yml [CUSTOM END]';
        $result = StringManipulator::getBetween($string, '[CUSTOM START]', '[CUSTOM END]');

        self::assertStringContainsString($result, ' config.yml ');
    }

    public function test_wrap_in(): void
    {
        $text = 'config.yml';
        $result = StringManipulator::wrapIn($text, '[CONFIG]');

        self::assertStringContainsString($text, '[CONFIG]config.yml[CONFIG]');
    }

}
