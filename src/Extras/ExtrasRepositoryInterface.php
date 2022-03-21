<?php


namespace Reinert\ComposerFileManipulator\Extras;


use Composer\Script\Event;

/**
 * Interface ExtrasRepositoryInterface
 *
 * @package Reinert\ComposerFileManipulator\Services\ExtrasRepository
 *
 */
interface ExtrasRepositoryInterface
{
    /**
     * IExtrasRepository constructor.
     * @param Event $event
     */
    public function __construct(Event $event);

    /**
     * @return array|null
     */
    public function all(): ?array;

    /**
     * @param string $name
     * @return array|null
     */
    public function find(string $name): ?array;
}