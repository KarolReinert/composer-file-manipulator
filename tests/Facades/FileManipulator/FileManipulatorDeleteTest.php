<?php


namespace Reinert\ComposerFileManipulator\Tests\Facades\FileManipulator;


use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\visitor\vfsStreamStructureVisitor;
use PHPUnit\Framework\TestCase;
use Reinert\ComposerFileManipulator\Facades\FileManipulator;

class FileManipulatorDeleteTest extends TestCase
{
    protected vfsStreamDirectory $root;
    protected vfsStreamDirectory $directory;

    protected function createStructure(): void
    {
        $structure = [
            'project' => [
                '.htaccess' => 'AccessFileName ".config"',
                'index.php' => '<?php'
            ]
        ];

        $this->directory = vfsStream::create($structure);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->root = vfsStream::setup();
        $this->createStructure();
    }

    public function test_to_delete_file(): void
    {
        $fileToRemove = vfsStream::url('root/project/.htaccess');

        FileManipulator::delete($fileToRemove);

        self::assertEquals(
            [
                'root' => [
                    'project' => [
                        'index.php' => '<?php',
                    ]
                ],
            ],
            vfsStream::inspect(new vfsStreamStructureVisitor())->getStructure()
        );
    }


}