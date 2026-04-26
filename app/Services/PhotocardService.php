<?php

namespace App\Services;

use App\Models\User;
use App\Models\Setting;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PhotocardService
{
    private const CANVAS_W = 1200;
    private const CANVAS_H = 1200;

    // ── FRAME LAYOUT MEASUREMENTS ──────────────────────────────────────
    private const PHOTO_X = 483;
    private const PHOTO_Y = 140;
    private const PHOTO_W = 573;
    private const PHOTO_H = 699;

    private const QR_X = 888;
    private const QR_Y = 910;
    private const QR_SIZE = 170;

    // ── FIXED TEXT COORDINATES ─────────────────────────────────────────
    private const NAME_X     = 192;
    private const NAME_Y     = 728;  // Dropped 40px to sit properly below "NAME"
    
    private const LOC_X      = 192;
    private const LOC_Y      = 845;  // Dropped 40px to sit properly below "LOCATION"
    
    private const TYPE_X     = 220; 
    private const TYPE_Y     = 1010; // Dropped 5px for perfect vertical centering
    
    private const ID_X       = 270;  // Shifted slightly left to attach to the colon
    private const ID_Y       = 1155; // Dropped 25px into the vertical center of the pill
    // ───────────────────────────────────────────────────────────────────

    public function generate(User $artist): string
    {
        if (
            $artist->photocard_path &&
            $artist->photocard_generated_at &&
            Storage::disk('public')->exists($artist->photocard_path) &&
            $artist->updated_at <= $artist->photocard_generated_at
        ) {
            return $artist->photocard_path;
        }

        $canvas = imagecreatetruecolor(self::CANVAS_W, self::CANVAS_H);

        imagealphablending($canvas, true);
        imagesavealpha($canvas, true);

        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefilledrectangle($canvas, 0, 0, self::CANVAS_W, self::CANVAS_H, $white);

        $this->placeAvatar($canvas, $artist);

        $settings  = Setting::first();
        $framePath = $settings?->photocard_frame
            ? Storage::disk('public')->path($settings->photocard_frame)
            : null;

        if ($framePath && file_exists($framePath)) {
            $this->overlayFrame($canvas, $framePath);
        }

        $this->placeQrCode($canvas, $artist);
        $this->overlayText($canvas, $artist);

        Storage::disk('public')->makeDirectory('photocards');

        $filename   = 'photocards/' . Str::slug($artist->name) . '-' . $artist->id . '.jpg';
        $outputPath = Storage::disk('public')->path($filename);

        imagejpeg($canvas, $outputPath, 95);
        imagedestroy($canvas);

        $artist->update([
            'photocard_path'         => $filename,
            'photocard_generated_at' => now(),
        ]);

        return $filename;
    }

    private function placeAvatar(\GdImage $canvas, User $artist): void
    {
        $avatarPath = null;

        if ($artist->hasMedia('avatar')) {
            $avatarPath = $artist->getFirstMedia('avatar')->getPath();
        } elseif ($artist->hasMedia('portfolio')) {
            $avatarPath = $artist->getFirstMedia('portfolio')->getPath();
        }

        if (!$avatarPath || !file_exists($avatarPath)) {
            $avatarPath = public_path('images/avatar-placeholder.jpg');
        }

        if (!file_exists($avatarPath)) {
            return; 
        }

        $src = $this->loadImage($avatarPath);
        if (!$src) {
            return;
        }

        $srcW = imagesx($src);
        $srcH = imagesy($src);

        $targetW = self::PHOTO_W;
        $targetH = self::PHOTO_H;

        $srcAspect    = $srcW / $srcH;
        $targetAspect = $targetW / $targetH;

        if ($srcAspect > $targetAspect) {
            $cropH = $srcH;
            $cropW = (int) ($srcH * $targetAspect);
            $cropX = (int) (($srcW - $cropW) / 2);
            $cropY = 0;
        } else {
            $cropW = $srcW;
            $cropH = (int) ($srcW / $targetAspect);
            $cropX = 0;
            $cropY = (int) (($srcH - $cropH) / 2);
        }

        $resized = imagecreatetruecolor($targetW, $targetH);
        imagecopyresampled($resized, $src, 0, 0, $cropX, $cropY, $targetW, $targetH, $cropW, $cropH);
        imagecopy($canvas, $resized, self::PHOTO_X, self::PHOTO_Y, 0, 0, $targetW, $targetH);

        imagedestroy($src);
        imagedestroy($resized);
    }

    private function overlayFrame(\GdImage $canvas, string $framePath): void
    {
        $frame = $this->loadImage($framePath);

        if (!$frame) {
            return;
        }

        $fw = imagesx($frame);
        $fh = imagesy($frame);

        if ($fw !== self::CANVAS_W || $fh !== self::CANVAS_H) {
            $scaled = imagecreatetruecolor(self::CANVAS_W, self::CANVAS_H);
            imagealphablending($scaled, false);
            imagesavealpha($scaled, true);
            imagecopyresampled($scaled, $frame, 0, 0, 0, 0, self::CANVAS_W, self::CANVAS_H, $fw, $fh);
            imagedestroy($frame);
            $frame = $scaled;
        }

        imagealphablending($canvas, true);
        imagecopy($canvas, $frame, 0, 0, 0, 0, self::CANVAS_W, self::CANVAS_H);
        imagedestroy($frame);
    }

    private function placeQrCode(\GdImage $canvas, User $artist): void
    {
        $profileUrl = route('artist.show', [
            'slug' => Str::slug($artist->name) . '-' . $artist->id,
        ]);

        $qrRaw = QrCode::format('png')
            ->size(self::QR_SIZE)
            ->margin(0)
            ->generate($profileUrl);

        $qrImg = imagecreatefromstring($qrRaw);
        if (!$qrImg) {
            return;
        }

        imagecopy($canvas, $qrImg, self::QR_X, self::QR_Y, 0, 0, self::QR_SIZE, self::QR_SIZE);
        imagedestroy($qrImg);
    }

    private function overlayText(\GdImage $canvas, User $artist): void
    {
        $boldFont    = public_path('fonts/Inter-Bold.ttf');
        $regularFont = public_path('fonts/Inter-Regular.ttf');

        $dark  = imagecolorallocate($canvas, 26, 26, 26);
        $muted = imagecolorallocate($canvas, 80, 80, 80);
        $white = imagecolorallocate($canvas, 255, 255, 255);

        // ── Name ──
        $name = strtoupper($artist->name);
        $this->drawAutoScaledText($canvas, self::NAME_X, self::NAME_Y, $dark, $boldFont, $name, 280, 2, 34, 20);

        // ── Location ──
        $upazila  = $artist->profile?->upazila ?? '';
        $district = $artist->profile?->district ?? '';
        $location = trim(($upazila ? $upazila . ', ' : '') . $district);

        if ($location) {
             $this->drawAutoScaledText($canvas, self::LOC_X, self::LOC_Y, $dark, $regularFont, $location, 280, 2, 24, 16);
        }

        // ── Member Type ──
        $memberType = collect($artist->profile?->categories ?? [])
            ->take(2)
            ->implode(', ');

        if ($memberType) {
            $this->drawAutoScaledText($canvas, self::TYPE_X, self::TYPE_Y, $white, $boldFont, $memberType, 600, 2, 24, 16);
        }
        
        // ── Member ID ──
        $memberId = $artist->member_id ?? ('DMA-' . now()->year . '-' . str_pad($artist->id, 4, '0', STR_PAD_LEFT));
        if (file_exists($regularFont)) {
            imagettftext($canvas, 15, 0, self::ID_X, self::ID_Y, $muted, $regularFont, $memberId);
        } else {
            imagestring($canvas, 3, self::ID_X, self::ID_Y, $memberId, $muted);
        }
    }

    /**
     * Draws text with automatic word wrapping and dynamic font shrinking.
     */
    private function drawAutoScaledText(\GdImage $canvas, int $startX, int $startY, int $color, string $font, string $text, int $maxWidth, int $maxLines, int $startFontSize, int $minFontSize = 12): void
    {
        if (!file_exists($font)) {
            imagestring($canvas, 5, $startX, $startY - 15, substr($text, 0, 30), $color);
            return;
        }

        $fontSize = $startFontSize;
        $lines = [];

        while ($fontSize >= $minFontSize) {
            $words = explode(' ', $text);
            $currentLine = '';
            $lines = [];

            foreach ($words as $word) {
                $testLine = $currentLine . ($currentLine === '' ? '' : ' ') . $word;
                $bbox = imagettfbbox($fontSize, 0, $font, $testLine);
                $width = $bbox[2] - $bbox[0];

                if ($width > $maxWidth && $currentLine !== '') {
                    $lines[] = $currentLine;
                    $currentLine = $word;
                } else {
                    $currentLine = $testLine;
                }
            }
            
            if ($currentLine !== '') {
                $lines[] = $currentLine;
            }

            // Break if it fits the line limits
            if (count($lines) <= $maxLines) {
                break; 
            }
            
            $fontSize -= 2; 
        }

        // Tighter line height multiplier (1.4) to keep wrapped text neat
        $lineHeight = (int) ($fontSize * 1.4);
        $currentY = $startY;
        
        foreach ($lines as $line) {
            imagettftext($canvas, $fontSize, 0, $startX, $currentY, $color, $font, $line);
            $currentY += $lineHeight;
        }
    }

    private function loadImage(string $path): ?\GdImage
    {
        $ext = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        $img = match ($ext) {
            'jpg', 'jpeg' => @imagecreatefromjpeg($path),
            'png'         => @imagecreatefrompng($path),
            'webp'        => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : false,
            'gif'         => @imagecreatefromgif($path),
            default       => false,
        };

        if (!$img) {
            $mime = @mime_content_type($path);
            $img  = match ($mime) {
                'image/jpeg' => @imagecreatefromjpeg($path),
                'image/png'  => @imagecreatefrompng($path),
                'image/webp' => function_exists('imagecreatefromwebp') ? @imagecreatefromwebp($path) : false,
                'image/gif'  => @imagecreatefromgif($path),
                default      => false,
            };
        }

        return $img instanceof \GdImage ? $img : null;
    }
}