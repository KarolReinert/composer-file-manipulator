<?php

namespace Reinert\ComposerFileManipulator\FileManager;


trait FileManagerTrait
{
    /** @return FileManager */
    private static function fileManager(): FileManager
    {
        return new FileManager();
    }
}