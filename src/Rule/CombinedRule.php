<?php declare(strict_types = 1);

namespace HelloFresh\Csv\Rule;

/**
 *
 */
final class CombinedRule implements RuleInterface
{
    /**
     * @var array
     */
    private $rules;

    /**
     * @param array $rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * {@inheritdoc}
     */
    public function check(string $value) : void
    {
        /** @var array $errors */
        $errors = array_reduce($this->rules, function (array $errors, RuleInterface $rule) use ($value) : array {
            try {
                $rule->check($value);
            } catch (RuleException $exception) {
                $errors[] = $exception->getMessage();
            }

            return $errors;
        }, []);

        if (!empty($errors)) {
            throw new RuleException(implode('. ', $errors));
        }
    }
}