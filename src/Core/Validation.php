<?php

namespace App\Core;

class Validation
{
    public function validate(array $data, array $rules): array
    {
        foreach ($data as $field => $value) {
            if (isset($rules[$field])) {
                foreach ($rules[$field] as $rule) {
                    if ($rule === 'required' && ($value === null || $value === '')) {
                        $errors[] = "$field is required.";
                    }
                    if ($rule === 'string' && !is_string($value)) {
                        $errors[] = "$field must be a string.";
                    }
                    if ($rule === 'float' && !is_numeric($value)) {
                        $errors[] = "$field must be a float.";
                    }
                    if ($rule === 'integer' && (filter_var($value, FILTER_VALIDATE_INT) === false)) {
                        $errors[] = "$field must be an integer.";
                    }
                    if ($rule === 'float:null' && !empty($value) && !is_numeric($value)) {
                        $errors[] = "$field must be a float or null.";
                    }
                }
            }
        }
        return $errors ?? [];
    }
}