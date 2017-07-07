<?php declare(strict_types = 1);

namespace HelloFresh\Csv\File;

/**
 * Represents a CSV that can be iterated over
 */
interface FileInterface
{
    /**
     * Return the rows in this CSV as an iterator
     *
     * @return \Iterator
     */
    public function rows() : \Iterator;
}