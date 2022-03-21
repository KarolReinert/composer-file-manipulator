<?php


namespace Reinert\ComposerFileManipulator\Commands;


use Reinert\ComposerFileManipulator\Facades\FileManipulator;

/**
 * Class CleanUpAbstractInterface
 *
 * @package Reinert\ComposerFileManipulator\Commands
 */
class DeleteCommand extends AbstractCommand implements CommandInterface
{
    public const COMMAND = 'delete-files';

    public function handle(): void
    {
        $toDelete = (array) $this->extras()->find(self::COMMAND);

        foreach ($toDelete as $path) {
            FileManipulator::delete($path);
        }
    }
}