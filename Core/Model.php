<?php


namespace App\Core;


use JetBrains\PhpStorm\ArrayShape;

abstract class Model
{
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MATCH = 'match';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public array $errors = [];

    public function loadData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    abstract public function rules(): array;

    public function validate(): bool
    {
        foreach ($this->rules() as $attribute => $rules) {
            $value = $this->$attribute;
            foreach ($rules as $rule) {
                // iterate the rule name
                $ruleName = $rule;

                // return ruleName if array is occured
                if (!is_string($ruleName)) {
                    $ruleName = $rule[0];
                }
                // handle empty field
                if ($ruleName === self::RULE_REQUIRED && !$value) {
                    $this->addError(attribute: $attribute, rule: self::RULE_REQUIRED);
                }
                // handle email
                if ($ruleName === self::RULE_EMAIL && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    $this->addError($attribute, self::RULE_EMAIL);
                }

                // handle min length
                if ($ruleName === self::RULE_MIN && strlen($value) < $rule['min']) {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }

                // handle max length
                if ($ruleName === self::RULE_MAX && strlen($value) > $rule['max']) {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }

                // handle match field
                if ($ruleName === self::RULE_MATCH && $value !== $rule['match']) {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }
        }
        return empty($this->errors);
    }

    // choose error
    private function addError(string $attribute, string $rule, array $params = []): void
    {
        // choose message base on rule
        $message = $this->errorMessage()[$rule] ?? '';
        foreach ($params as $key => $value) {
            $message = str_replace("{{$key}}", $value, $message);
        }

        $this->errors[$attribute][] = $message;
    }

    #[ArrayShape([self::RULE_REQUIRED => "string", self::RULE_EMAIL => "string", self::RULE_MIN => "string", self::RULE_MAX => "string", self::RULE_MATCH => "string"])] public function errorMessage(): array
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be valid email adress',
            self::RULE_MIN => 'This field must has minimum {min} characters',
            self::RULE_MAX => 'This field must has maximum {max} characters',
            self::RULE_MATCH => 'This field must be same as {match} field'
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}