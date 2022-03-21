<?php


namespace Reinert\ComposerFileManipulator\Facades;


use Reinert\ComposerFileManipulator\FileManager\FileManagerTrait;
use Reinert\ComposerFileManipulator\Logger\Log;

/**
 * Class FileService
 *
 * @package Reinert\ComposerFileManipulator\Services
 */
class FileManipulator
{
    use FileManagerTrait;

    /**
     * @param string $from
     * @param string $to
     */
    public static function copy(string $from, string $to): void
    {
        try {
           self::fileManager()->copy($from, $to);
            Log::notice("File: {$to}  was copied successfully");
        } catch (\Exception $exception) {
            Log::warning("Failed to copy a file FromFilePath: ${from} ToFilePath: ${to} ");
        }
    }

    /**
     * @param string $from @param string $to
     * @param string $to
     */
    public static function move(string $from, string $to): void
    {
        if(self::fileManager()->exists($from)) {
            self::copy($from, $to);
        }

        if(self::fileManager()->exists($to)) {
            try {
                self::fileManager()->delete([$from]);
                Log::notice("File: {$to}  was moved successfully");
            } catch (\Exception $exception) {
                Log::warning("Failed to delete a file while while moving from: {$from} to: {$to}");
            }
        }
    }

    /** Delete file
     * @param string $filePath
     */
    public static function delete(string $filePath): void
    {
        try {
            self::fileManager()->delete([$filePath]);
            Log::notice("File: {$filePath}  was deleted successfully");
        } catch (\Exception $e) {
            Log::warning("Failed to delete {$filePath}");
        }
    }

}