<?php declare(strict_types = 1);

namespace HelloFresh\Csv\Schema;

use HelloFresh\Csv\RuleCollection\RuleCollectionInterface;

/**
 * Represents a schema that's used to validate a CSV
 */
interface SchemaInterface
{
    /**
     * @return RuleCollectionInterface
     */
    public function rules() : RuleCollectionInterface;
}