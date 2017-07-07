<?php declare(strict_types = 1);

namespace HelloFresh\Csv\File;

use HelloFresh\Csv\RuleCollection\RuleCollectionInterface;

/**
 * A validated CSV
 */
final class ValidatedCsvFile implements FileInterface
{
    /**
     * @var FileInterface
     */
    private $csv;

    /**
     * @var RuleCollectionInterface
     */
    private $rules;

    /**
     * @param FileInterface $csv
     * @param RuleCollectionInterface $rules
     */
    public function __construct(FileInterface $csv, RuleCollectionInterface $rules)
    {
        $this->csv = $csv;
        $this->rules = $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function rows() : \Iterator
    {
        foreach ($this->csv->rows() as $row) {
            $this->validate($row);
            yield $row;
        }
    }

    /**
     * @param array $row
     *
     * @return void
     */
    private function validate(array $row) : void
    {
        foreach ($row as $key => $value) {
            $this->rules->rule($key)->check($value);
        }
    }
}