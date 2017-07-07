<?php declare(strict_types = 1);

namespace HelloFresh\Csv\RuleCollection;

use HelloFresh\Csv\Rule\RuleInterface;

/**
 * Represents a collection of rules
 */
interface RuleCollectionInterface
{
    /**
     * @param string $key
     * @param RuleInterface $rule
     *
     * @return RuleCollectionInterface
     */
    public function withRule(string $key, RuleInterface $rule) : RuleCollectionInterface;

    /**
     * @param string $key
     *
     * @return RuleInterface
     */
    public function rule(string $key) : RuleInterface;
}