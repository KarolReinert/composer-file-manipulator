<?php

namespace Reinert\ComposerFileManipulator\Commands;


use Reinert\ComposerFileManipulator\Facades\FileManipulator;

/**
 * Class FileMoveAbstractCommandInterface
 *
 * @package Reinert\ComposerFileManipulator\Commands
 */
class FileMoveCommand extends AbstractCommand implements CommandInterface
{
    public const COMMAND = 'move-files';

    public function handle(): void
    {
        $filesToMove = (array) $this->extras()->find(self::COMMAND);

        foreach ($filesToMove as $from => $to) {
            FileManipulator::move($from, $to);
        }
    }
}