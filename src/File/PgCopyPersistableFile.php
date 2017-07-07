<?php declare(strict_types = 1);

namespace HelloFresh\Csv\File;

use Symfony\Component\Process\Process;

/**
 * A decorator for CSV files that allows them to be persisted using PG copy
 */
final class PgCopyPersistableFile implements PersistableFileInterface
{
    /**
     * @var FileInterface
     */
    private $file;

    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $table;

    /**
     * @param FileInterface $file
     * @param string $host
     * @param string $database
     * @param string $username
     * @param string $password
     * @param string $table
     */
    public function __construct(
        FileInterface $file,
        string $host,
        string $database,
        string $username,
        string $password,
        string $table
    ) {
        $this->file = $file;
        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
        $this->table = $table;
    }

    /**
     * {@inheritdoc}
     */
    public function rows() : \Iterator
    {
        $this->file->rows();
    }

    /**
     * @return void
     */
    public function persist() : void
    {
        // Make a new temporary file for the CSV file to be read from for uploading
        $tmp = new \SplTempFileObject();

        // Pipe all rows into a temporary file
        iterator_to_array((new PipedCsvFile($this->file, $tmp))->rows());

        (new Process(
            sprintf("
                PGPASSWORD=%s 
                psql --host %s 
                    --dbname %s 
                    --username %s 
                    --command \"\copy %s from '%s' with delimiter ',' null 'null' csv header quote '|'\"",
                $this->password,
                $this->host,
                $this->database,
                $this->username,
                $this->table,
                $tmp->getRealPath()
            )
        ))->run();
    }
}