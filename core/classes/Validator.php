<?php

namespace Core\Classes;

class Validator {
    private array $errors = [];
    private array $rules;
    private array $messages;
    private array $fields;

    public function __construct(array $fields, array $rules, array $messages) {
        $this->rules = $rules;
        $this->messages = $messages;
        $this->fields = $fields;
    }

    public function validate(): void {
        foreach ($this->rules as $name => $rule) {
            foreach ($rule as $value) {
                $explode = explode(':', $value);
                switch ($explode[0]) {
                    case 'required':
                        $this->required($name);
                        break;
                    case 'max':
                        $this->max($name, intval($explode[1]));
                        break;
                    case 'min':
                        $this->min($name, intval($explode[1]));
                        break;
                    case 'ext':
                        $this->ext($name, $explode[1]);
                        break;
                    case 'email':
                        $this->email($name);
                        break;
                }
            }
        }
    }

    private function required(string $fieldName): void {
        if (empty($this->fields[$fieldName])) {
            $this->setError($fieldName, 'required');
        }
    }

    private function max(string $fieldName, int $value): void {
        if (mb_strlen($this->fields[$fieldName]) > $value) {
            $this->setError($fieldName, 'max', $value);
        }
    }

    private function min(string $fieldName, int $value): void {
        if (mb_strlen($this->fields[$fieldName]) < $value) {
            $this->setError($fieldName, 'min', $value);
        }
    }

    protected function email(string $fieldName): void {
        if (!filter_var($this->fields[$fieldName], FILTER_VALIDATE_EMAIL)) {
            $this->setError($fieldName, 'email', $this->fields[$fieldName]);
        }
    }

    protected function ext(string $fieldName, string $rules): void {
        $file = $this->fields[$fieldName];

        if (!empty($file["name"])) {
            $fileExt = pathinfo($file['name'], PATHINFO_EXTENSION);
            $allowedExts = explode('|', $rules);

            if (!in_array($fileExt, $allowedExts)) {
                $this->setError($fieldName, 'ext', implode(", ", $allowedExts));
            }
        }
    }

    private function setError(string $fieldName, string $rule, mixed $value = NULL): void {
        $message = $this->messages[$fieldName][$rule];
        $length = count($this->errors[$fieldName] ?? []);

        if ($value !== NULL) {
            $message = str_replace(":$rule", $value, $message);
        }

        $this->errors[$fieldName][$length] = $message;
    }

    public function addError(string $fieldName, string $message): void {
        $length = count($this->errors[$fieldName] ?? []);
        $this->errors[$fieldName][$length] = $message;
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function hasErrors(): bool {
        return !empty($this->errors);
    }
}