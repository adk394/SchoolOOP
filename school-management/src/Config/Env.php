<?php

declare(strict_types=1);

namespace SchoolManagement\Config;

final class Env
{
    private static array $vars = [];
    private static bool $loaded = false;

    public static function load(string $path = '.env'): void
    {
        if (self::$loaded) {
            return;
        }

        if (file_exists($path)) {
            $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($lines as $line) {
                if (str_starts_with($line, '#') || strpos($line, '=') === false) {
                    continue;
                }
                [$key, $value] = explode('=', $line, 2);
                self::$vars[trim($key)] = trim($value);
            }
        }

        self::$loaded = true;
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        return self::$vars[$key] ?? $default;
    }
}
