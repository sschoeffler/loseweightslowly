<?php

namespace App\Services;

use App\Models\Recipe;

class OpenGraphImageGenerator
{
    private const WIDTH = 1200;
    private const HEIGHT = 630;
    private const ACCENT_HEIGHT = 8;

    private string $fontRegular;
    private string $fontMedium;
    private string $fontSemiBold;

    public function __construct()
    {
        $this->fontRegular = resource_path('fonts/Figtree-Regular.ttf');
        $this->fontMedium = resource_path('fonts/Figtree-Medium.ttf');
        $this->fontSemiBold = resource_path('fonts/Figtree-SemiBold.ttf');
    }

    public function generateForRecipe(Recipe $recipe): string
    {
        $dir = storage_path('app/public/og-images/recipe');
        $path = $dir . '/' . $recipe->slug . '.png';

        if (file_exists($path)) {
            return $path;
        }

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $img = imagecreatetruecolor(self::WIDTH, self::HEIGHT);

        // Colors
        $white = imagecolorallocate($img, 255, 255, 255);
        $indigo = imagecolorallocate($img, 79, 70, 229);    // indigo-600
        $indigoLight = imagecolorallocate($img, 238, 242, 255); // indigo-50
        $emerald = imagecolorallocate($img, 5, 150, 105);    // emerald-600
        $emeraldLight = imagecolorallocate($img, 236, 253, 245); // emerald-50
        $gray800 = imagecolorallocate($img, 31, 41, 55);
        $gray500 = imagecolorallocate($img, 107, 114, 128);
        $gray200 = imagecolorallocate($img, 229, 231, 235);

        // White background
        imagefilledrectangle($img, 0, 0, self::WIDTH, self::HEIGHT, $white);

        // Indigo accent bar at top
        imagefilledrectangle($img, 0, 0, self::WIDTH, self::ACCENT_HEIGHT, $indigo);

        // Branding
        imagettftext($img, 18, 0, 60, 65, $indigo, $this->fontSemiBold, 'Lose Weight Slowly');

        // Subtle separator line
        imagefilledrectangle($img, 60, 85, self::WIDTH - 60, 86, $gray200);

        // Recipe name (large, wrapped)
        $this->drawWrappedText(
            $img,
            $recipe->name,
            $this->fontSemiBold,
            36,
            60,
            140,
            self::WIDTH - 120,
            $gray800,
            50
        );

        // Calculate Y position after recipe name
        $nameLines = $this->getWrappedLines($recipe->name, $this->fontSemiBold, 36, self::WIDTH - 120);
        $badgeY = 140 + (count($nameLines) * 50) + 20;

        // Badges row
        $badgeX = 60;

        // Diet badge (emerald)
        if ($recipe->diet) {
            $badgeX = $this->drawBadge($img, $recipe->diet->name . ' Diet', $badgeX, $badgeY, $emerald, $emeraldLight);
        }

        // Cuisine badge (indigo)
        if ($recipe->cuisine) {
            $badgeX = $this->drawBadge($img, $recipe->cuisine->name, $badgeX, $badgeY, $indigo, $indigoLight);
        }

        // Meal type badge
        $this->drawBadge($img, ucfirst($recipe->meal_type), $badgeX, $badgeY, $gray500, $gray200);

        // Stats row at bottom
        $statsY = self::HEIGHT - 100;

        // Subtle separator above stats
        imagefilledrectangle($img, 60, $statsY - 30, self::WIDTH - 60, $statsY - 29, $gray200);

        $statsX = 60;

        if ($recipe->calories) {
            $statsX = $this->drawStat($img, (string)$recipe->calories, 'calories', $statsX, $statsY, $gray800, $gray500);
        }

        if ($recipe->protein) {
            $statsX = $this->drawStat($img, $recipe->protein . 'g', 'protein', $statsX, $statsY, $gray800, $gray500);
        }

        if ($recipe->prep_time) {
            $this->drawStat($img, $recipe->prep_time . ' min', 'prep time', $statsX, $statsY, $gray800, $gray500);
        }

        // Bottom accent bar
        imagefilledrectangle($img, 0, self::HEIGHT - self::ACCENT_HEIGHT, self::WIDTH, self::HEIGHT, $indigo);

        // URL branding at bottom right
        imagettftext($img, 14, 0, self::WIDTH - 310, self::HEIGHT - 30, $gray500, $this->fontRegular, 'loseweightslowly.com');

        imagepng($img, $path);
        imagedestroy($img);

        return $path;
    }

    public function generateDefault(): string
    {
        $dir = storage_path('app/public/og-images');
        $path = $dir . '/default.png';

        if (file_exists($path)) {
            return $path;
        }

        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }

        $img = imagecreatetruecolor(self::WIDTH, self::HEIGHT);

        $white = imagecolorallocate($img, 255, 255, 255);
        $indigo = imagecolorallocate($img, 79, 70, 229);
        $gray800 = imagecolorallocate($img, 31, 41, 55);
        $gray500 = imagecolorallocate($img, 107, 114, 128);

        imagefilledrectangle($img, 0, 0, self::WIDTH, self::HEIGHT, $white);
        imagefilledrectangle($img, 0, 0, self::WIDTH, self::ACCENT_HEIGHT, $indigo);
        imagefilledrectangle($img, 0, self::HEIGHT - self::ACCENT_HEIGHT, self::WIDTH, self::HEIGHT, $indigo);

        imagettftext($img, 48, 0, 60, 260, $indigo, $this->fontSemiBold, 'Lose Weight Slowly');
        imagettftext($img, 24, 0, 60, 320, $gray800, $this->fontRegular, 'Healthy recipes & meal plans for sustainable weight loss');
        imagettftext($img, 18, 0, 60, 400, $gray500, $this->fontRegular, 'Browse recipes by diet, cuisine, and meal type');

        imagettftext($img, 14, 0, self::WIDTH - 310, self::HEIGHT - 30, $gray500, $this->fontRegular, 'loseweightslowly.com');

        imagepng($img, $path);
        imagedestroy($img);

        return $path;
    }

    private function drawBadge(\GdImage $img, string $text, int $x, int $y, int $textColor, int $bgColor): int
    {
        $fontSize = 16;
        $paddingX = 16;
        $paddingY = 8;
        $gap = 12;

        $bbox = imagettfbbox($fontSize, 0, $this->fontMedium, $text);
        $textWidth = $bbox[2] - $bbox[0];
        $textHeight = $bbox[1] - $bbox[7];

        $badgeWidth = $textWidth + ($paddingX * 2);
        $badgeHeight = $textHeight + ($paddingY * 2);

        // Draw rounded rectangle background (approximated with filled rectangle + circles)
        $radius = 6;
        $this->drawRoundedRect($img, $x, $y, $x + $badgeWidth, $y + $badgeHeight, $radius, $bgColor);

        // Draw text centered in badge
        $textX = $x + $paddingX;
        $textY = $y + $paddingY + $textHeight;
        imagettftext($img, $fontSize, 0, $textX, $textY, $textColor, $this->fontMedium, $text);

        return $x + $badgeWidth + $gap;
    }

    private function drawStat(\GdImage $img, string $value, string $label, int $x, int $y, int $valueColor, int $labelColor): int
    {
        $gap = 60;

        imagettftext($img, 24, 0, $x, $y, $valueColor, $this->fontSemiBold, $value);
        imagettftext($img, 14, 0, $x, $y + 25, $labelColor, $this->fontRegular, $label);

        $bbox = imagettfbbox(24, 0, $this->fontSemiBold, $value);
        $labelBbox = imagettfbbox(14, 0, $this->fontRegular, $label);
        $wider = max($bbox[2] - $bbox[0], $labelBbox[2] - $labelBbox[0]);

        return $x + $wider + $gap;
    }

    private function drawWrappedText(\GdImage $img, string $text, string $font, int $size, int $x, int $y, int $maxWidth, int $color, int $lineHeight): void
    {
        $lines = $this->getWrappedLines($text, $font, $size, $maxWidth);

        foreach ($lines as $i => $line) {
            imagettftext($img, $size, 0, $x, $y + ($i * $lineHeight), $color, $font, $line);
        }
    }

    private function getWrappedLines(string $text, string $font, int $size, int $maxWidth): array
    {
        $words = explode(' ', $text);
        $lines = [];
        $currentLine = '';

        foreach ($words as $word) {
            $testLine = $currentLine === '' ? $word : $currentLine . ' ' . $word;
            $bbox = imagettfbbox($size, 0, $font, $testLine);
            $lineWidth = $bbox[2] - $bbox[0];

            if ($lineWidth > $maxWidth && $currentLine !== '') {
                $lines[] = $currentLine;
                $currentLine = $word;
            } else {
                $currentLine = $testLine;
            }
        }

        if ($currentLine !== '') {
            $lines[] = $currentLine;
        }

        // Limit to 3 lines max, truncate last line if needed
        if (count($lines) > 3) {
            $lines = array_slice($lines, 0, 3);
            $lines[2] = rtrim($lines[2], '.') . '...';
        }

        return $lines;
    }

    private function drawRoundedRect(\GdImage $img, int $x1, int $y1, int $x2, int $y2, int $radius, int $color): void
    {
        // Fill main body
        imagefilledrectangle($img, $x1 + $radius, $y1, $x2 - $radius, $y2, $color);
        imagefilledrectangle($img, $x1, $y1 + $radius, $x2, $y2 - $radius, $color);

        // Fill corners with filled arcs
        imagefilledellipse($img, $x1 + $radius, $y1 + $radius, $radius * 2, $radius * 2, $color);
        imagefilledellipse($img, $x2 - $radius, $y1 + $radius, $radius * 2, $radius * 2, $color);
        imagefilledellipse($img, $x1 + $radius, $y2 - $radius, $radius * 2, $radius * 2, $color);
        imagefilledellipse($img, $x2 - $radius, $y2 - $radius, $radius * 2, $radius * 2, $color);
    }
}
