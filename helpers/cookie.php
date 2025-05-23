<?php
// Set a cookie safely
function setSecureCookie(string $name, string $value, int $expire = 0, string $path = '/', string $domain = '', bool $secure = false, bool $httponly = true) {
    setcookie($name, $value, [
        'expires' => $expire,
        'path' => $path,
        'domain' => $domain ?: $_SERVER['HTTP_HOST'],
        'secure' => $secure || isset($_SERVER['HTTPS']),
        'httponly' => $httponly,
        'samesite' => 'Strict'
    ]);
}

// Get a cookie value or null if not set
function getCookie(string $name): ?string {
    return $_COOKIE[$name] ?? null;
}

// Delete a cookie
function deleteCookie(string $name, string $path = '/', string $domain = '') {
    setcookie($name, '', time() - 3600, $path, $domain ?: $_SERVER['HTTP_HOST']);
}
