<?php declare(strict_types = 1);

namespace HelloFresh\Csv\File;

/**
 * Represents a CSV file
 */
final class CsvFile implements FileInterface
{
    /**
     * @var \SplFileObject
     */
    private $file;

    /**
     * @var array
     */
    private $headers;

    /**
     * @param \SplFileObject $file
     */
    public function __construct(\SplFileObject $file)
    {
        $this->file = $file;
        $this->headers = $file->fgetcsv();
    }

    /**
     * {@inheritdoc}
     */
    public function rows() : \Iterator
    {
        yield array_combine($this->headers, $this->file->fgetcsv());
    }
}