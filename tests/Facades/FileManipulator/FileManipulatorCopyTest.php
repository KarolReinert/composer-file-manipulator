<?php

namespace Reinert\ComposerFileManipulator\Tests\Facades\FileManipulator;


use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\visitor\vfsStreamStructureVisitor;
use PHPUnit\Framework\TestCase;
use Reinert\ComposerFileManipulator\Facades\FileManipulator;


class FileManipulatorCopyTest extends TestCase
{
    protected vfsStreamDirectory $root;
    protected vfsStreamDirectory $directory;

    protected function createStructure(): void
    {
        $structure = [
            'project' => [
                '.htaccess' => 'AccessFileName ".config"',
                'index.php' => '<?php'
            ],
            'panel' => []
        ];

        $this->directory = vfsStream::create($structure);
    }

    protected function setUp(): void
    {
        parent::setUp();
        $this->root = vfsStream::setup();
        $this->createStructure();
    }

    public function test_file_copy(): void
    {
        $from = vfsStream::url('root/project/.htaccess');
        $to = vfsStream::url('root/panel/.htaccess');

        FileManipulator::copy($from, $to);

        self::assertEquals(
            [
                'root' => [
                    'project' => [
                        '.htaccess' => 'AccessFileName ".config"',
                        'index.php' => '<?php'
                    ],
                    'panel' => [
                        '.htaccess' => 'AccessFileName ".config"',
                    ]
                ],
            ],
            vfsStream::inspect(new vfsStreamStructureVisitor())->getStructure()
        );
    }

    /**
     * Copy file with changed name
     */
    public function test_file_copy_and_name_change(): void
    {
        $from = vfsStream::url('root/project/.htaccess');
        $to = vfsStream::url('root/panel/.htaccessOtherName');

        FileManipulator::copy($from, $to);
        
        self::assertEquals(
            [
                'root' => [
                    'project' => [
                        '.htaccess' => 'AccessFileName ".config"',
                        'index.php' => '<?php'
                    ],
                    'panel' => [
                        '.htaccessOtherName' => 'AccessFileName ".config"',
                    ]
                ],
            ],
            vfsStream::inspect(new vfsStreamStructureVisitor())->getStructure()
        );
    }
}
