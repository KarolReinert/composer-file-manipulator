<?php


namespace Reinert\ComposerFileManipulator\Commands;

use Reinert\ComposerFileManipulator\Facades\FileManipulator;

/**
 * Class FileCopyAbstractCommand
 *
 * @package Reinert\ComposerFileManipulator\Commands
 */
class FileCopyCommand extends AbstractCommand implements CommandInterface
{
    public const COMMAND = 'copy-files';

    public function handle(): void
    {
        $filesToCopy = (array) $this->extras()->find(self::COMMAND);

        foreach ($filesToCopy as $from => $to) {
            FileManipulator::copy($from, $to);
        }
    }

}