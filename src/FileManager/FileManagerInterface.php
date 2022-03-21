<?php


namespace Reinert\ComposerFileManipulator\FileManager;


/**
 * Interface IFileManager
 *
 * @package Reinert\ComposerFileManipulator\Services\FileManager
 */
interface FileManagerInterface
{
    public function find(string $path, string $fileName);

    public function update(string $path, string $content = ''): void;

    public function copy(string $from, string $to): void;

    public function move(string $from, string $to): void;

    public function write(string $path, string $content = ''): void;

    public function delete(array $paths): void;

    public function rename(string $from, string $to): void;

    public function append(string $path, string $content): void;

    public function getContent(string $path): ?string;

}