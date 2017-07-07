<?php declare(strict_types = 1);

namespace HelloFresh\Csv\File;

/**
 * Represents a CSV file that can be persisted somewhere
 */
interface PersistableFileInterface extends FileInterface
{
    /**
     * @return void
     */
    public function persist() : void;
}