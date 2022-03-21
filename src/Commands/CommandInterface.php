<?php


namespace Reinert\ComposerFileManipulator\Commands;


/**
 * Interface CommandInterface
 *
 * @package Reinert\ComposerFileManipulator\Commands
 */
interface CommandInterface
{
    public function handle(): void;
}