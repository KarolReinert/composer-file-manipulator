<?php


namespace Reinert\ComposerFileManipulator\FileManager;


use Exception;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Filesystem\Exception\IOException;

/**
 * Class FileManager
 *
 * Adapter for Symfony filesystem and contains custom functions.
 *
 * @package Reinert\ComposerFileManipulator\Services
 */
class FileManager implements FileManagerInterface
{
    /** @var Filesystem */
    protected Filesystem $filesystem;

    /** @var Finder */
    protected Finder $finder;

    /**
     * FileManager constructor.
     */
    public function __construct()
    {
        $this->filesystem = new Filesystem();
        $this->finder = new Finder();
    }

    /**
     * Check if file exists in $path
     *
     * @param string $path
     * @return bool
     */
    public function exists(string $path): bool
    {
        return $this->filesystem->exists($path);
    }

    /**
     * Check if file is not exists in $path
     *
     * @param string $path
     * @return bool
     */
    public function notExists(string $path): bool
    {
        return !$this->exists($path);
    }

    /**
     * Find files or directories by pattern or name.
     *
     * @param string $path
     * @param string $fileName
     *
     * @return Finder
     */
    public function find(string $path, string $fileName): Finder
    {
        return $this->finder->path($path)->name($fileName);
    }

    /**
     * Touch file by given $path
     *
     * @param string $path Path to file.
     */
    public function touch(string $path): void
    {
        $this->filesystem->touch($path);
    }

    /**
     * Update file content.
     *
     * @param string $path
     * @param string $content
     *
     * @return void
     */
    public function update(string $path, string $content = ''): void
    {
        $this->filesystem->dumpFile($path, $content);
    }

    /**
     * Update alias.
     *
     * @param string $path
     * @param string $content
     *
     * @return void
     */
    public function write(string $path, string $content = ''): void
    {
        $this->update($path, $content);
    }

    /**
     * Copy single file or entire directory to another path.
     *
     * @param string $from
     * @param string $to
     *
     * @return void
     */
    public function copy(string $from, string $to): void
    {
        is_dir($from) ? $this->filesystem->mirror($from, $to) : $this->filesystem->copy($from, $to);
    }

    /**
     * Move file or files in given directory to another path.
     *
     * @param string $from
     * @param string $to
     *
     * @throws IOException
     *
     * @return void
     */
    public function move(string $from, string $to): void
    {
        $this->copy($from, $to);
        $this->delete([$from]);
    }

    /**
     * Remove files and directories from given array.
     *
     * @param array $paths
     * @throws IOException
     */
    public function delete(array $paths): void
    {
        $this->filesystem->remove($paths);
    }

    /**
     * Rename files and directories by given path to another.
     *
     * @param string $from
     * @param string $to
     * @throws IOException
     */
    public function rename(string $from, string $to): void
    {
        $this->filesystem->rename($from, $to);
    }

    /**
     * Create symlink or duplicate source directory if not supported.
     *
     * @param string $from
     * @param string $to
     * @throws IOException
     */
    public function symlink(string $from, string $to): void
    {
        $this->filesystem->symlink($from, $to);
    }

    /**
     * Append content to file.
     *
     * @param string $path
     * @param string $content
     *
     * @throws IOException
     *
     * @return void
     */
    public function append(string $path, string $content): void
    {
        $this->filesystem->appendToFile($path, $content);
    }


    /**
     * Get file content if not returns null.
     *
     * @param string $path
     *
     *
     * @throws Exception
     * @return string|null
     */
    public function getContent(string $path): ?string
    {
        $content = file_get_contents($path);

        if ($content === false) {
            return null;
        }
        return $content;
    }

}