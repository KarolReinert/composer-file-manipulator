<?php


namespace Reinert\ComposerFileManipulator\Extras;


use Composer\Script\Event;

/**
 * Class ExtrasRepository
 *
 * @package Reinert\ComposerFileManipulator\Services\ExtrasRepository
 *
 */
class ExtrasRepository implements ExtrasRepositoryInterface
{
    /**
     * @var Event
     */
    protected Event $event;

    /**
     * ExtrasRepository constructor.
     *
     * @param Event $event
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Get all extras from event.
     *
     * @return array|null
     */
    public function all(): ?array
    {
        return $this->event->getComposer()->getPackage()->getExtra();
    }

    /**
     * Find extras by name.
     *
     * @param string $name
     * @return array|null
     */
    public function find(string $name): ?array
    {
        return $this->all()[$name];
    }


}