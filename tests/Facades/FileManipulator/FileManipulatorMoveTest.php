<?php

namespace Reinert\ComposerFileManipulator\Tests\Facades\FileManipulator;


use org\bovigo\vfs\vfsStream;
use org\bovigo\vfs\vfsStreamDirectory;
use org\bovigo\vfs\visitor\vfsStreamStructureVisitor;
use PHPUnit\Framework\TestCase;
use Reinert\ComposerFileManipulator\Facades\FileManipulator;

class FileManipulatorMoveTest extends TestCase
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

    public function test_moving_a_file(): void
    {
        $from = vfsStream::url('root/project/.htaccess');
        $to = vfsStream::url('root/panel/.htaccess');

        FileManipulator::move($from, $to);

        self::assertEquals(
            [
                'root' => [
                    'project' => [
                        'index.php' => '<?php',
                    ],
                    'panel' => [
                        '.htaccess' => 'AccessFileName ".config"',
                    ]
                ],
            ],
            vfsStream::inspect(new vfsStreamStructureVisitor())->getStructure()
        );
    }

}
