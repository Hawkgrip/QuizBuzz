<?php
// Validate username (3-20 chars, letters, numbers, underscore)
function validateUsername(string $username): bool {
    return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username) === 1;
}

// Validate password length (min 6 chars)
function validatePassword(string $password): bool {
    return strlen($password) >= 6;
}

// Validate email format
function validateEmail(string $email): bool {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

// Validate user role
function validateRole(string $role): bool {
    $allowedRoles = ['admin', 'teacher', 'student'];
    return in_array($role, $allowedRoles, true);
}

// Validate quiz question type
function validateQuestionType(string $type): bool {
    $allowedTypes = ['mcq', 'true_false', 'matching', 'essay'];
    return in_array(strtolower($type), $allowedTypes, true);
}

// Sanitize string input
function sanitizeString(string $input): string {
    return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
}
