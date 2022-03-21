<?php

namespace Reinert\ComposerFileManipulator\Commands;


use Composer\Script\Event;
use InvalidArgumentException;
use Reinert\ComposerFileManipulator\Extras\ExtrasRepository;

/**
 * Class AbstractCommand
 *
 * @package Reinert\ComposerFileManipulator\Commands
 */
abstract class AbstractCommand
{
    /** Composer Event @var Event $event */
    protected Event $event;

    /** Constructor @param Event $event */
    public function __construct(Event $event)
    {
        if (!isset($event)) {
            throw new InvalidArgumentException('This event was not found! ');
        }

        /** @var Event */
        $this->event = $event;
    }

    /**
     * @return ExtrasRepository
     */
    public function extras(): ExtrasRepository
    {
        return new ExtrasRepository($this->event);
    }

}