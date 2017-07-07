<?php declare(strict_types = 1);

namespace HelloFresh\Csv\File;

/**
 * Represents a CSV that is piped to another file as it's read
 */
final class PipedCsvFile implements FileInterface
{
    /**
     * @var FileInterface
     */
    private $source;

    /**
     * @var \SplFileObject
     */
    private $destination;

    /**
     * @param FileInterface $source
     * @param \SplFileObject $destination
     */
    public function __construct(FileInterface $source, \SplFileObject $destination)
    {
        $this->source = $source;
        $this->destination = $destination;
    }

    /**
     * {@inheritdoc}
     */
    public function rows() : \Iterator
    {
        foreach ($this->source->rows() as $row) {
            $this->destination->fputcsv($row);
            yield $row;
        }
    }
}