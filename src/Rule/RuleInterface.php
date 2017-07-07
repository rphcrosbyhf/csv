<?php declare(strict_types = 1);

namespace HelloFresh\Csv\Rule;

/**
 * Represents a validation rule
 */
interface RuleInterface
{
    /**
     * Check if the value passes this rule
     *
     * @param string $value
     *
     * @throws RuleException
     */
    public function check(string $value) : void;
}