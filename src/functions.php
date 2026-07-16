<?php

if (!function_exists("generate_random_hex_string")) {
    function generate_random_hex_string(int $length, string $charCase): string
    {
        $result = "";

        $chars =
            strtolower($charCase) == "lower"
                ? "0123456789abcdef"
                : "0123456789ABCDEF";

        $charsLength = strlen($chars);

        for ($i = 0; $i < $length; $i++) {
            $result .= $chars[random_int(0, $charsLength - 1)];
        }

        return $result;
    }
}

if (!function_exists("generate_hex_strings")) {
    function generate_hex_strings(
        int $length = 10,
        int $quantity = 1,
        string $charCase = "lower",
        string $prefix = "",
        string $suffix = "",
    ): string|array {
        if ($length <= 0 || $length > 256) {
            return "Inserire una lunghezza valida (1-256)";
        }

        if ($quantity <= 0 || $quantity > 100) {
            return "Inserire una quantità valida (1-100)";
        }

        $generatedHex = [];

        for ($i = 0; $i < $length; $i++) {
            $singleHex = generate_random_hex_string(
                length: $length,
                charCase: $charCase,
            );
            array_push($generatedHex, $prefix . $singleHex . $suffix);
        }
        return $generatedHex;
    }
}
