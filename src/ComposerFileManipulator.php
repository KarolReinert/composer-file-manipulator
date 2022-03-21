<?php


namespace Reinert\ComposerFileManipulator;


use Composer\Script\Event;
use Reinert\ComposerFileManipulator\Commands\DeleteCommand;
use Reinert\ComposerFileManipulator\Commands\FileCopyCommand;
use Reinert\ComposerFileManipulator\Commands\FileMoveCommand;

/**
 * Class ComposerFileManipulator
 *
 * @package Reinert\ComposerFileManipulator
 */
class ComposerFileManipulator
{
    /**
     * Copy or update files
     * @param Event $event
     * @return void
     */
    public static function copy(Event $event): void
    {
        (new FileCopyCommand($event))->handle();
    }

    /**
     * Move files to another location
     * @param Event $event
     * @return void
     */
    public static function move(Event $event): void
    {
        (new FileMoveCommand($event))->handle();
    }

    /**
     * Delete files
     * @param Event $event
     * @return void
     */
    public static function delete(Event $event): void
    {
        (new DeleteCommand($event))->handle();
    }
    
}