<?php

namespace App\Helpers;

class ImageHelper
{
    /**
     * Default profile picture dimensions
     */
    const PROFILE_PICTURE_WIDTH = 400;
    const PROFILE_PICTURE_HEIGHT = 400;
    
    /**
     * Resize and save image to specific dimensions for profile pictures
     * This ensures all profile pictures are exactly 600x600px
     */
    public static function resizeProfilePicture($sourcePath, $destinationPath, $quality = 90)
    {
        return self::resizeAndSaveImage(
            $sourcePath, 
            $destinationPath, 
            self::PROFILE_PICTURE_WIDTH, 
            self::PROFILE_PICTURE_HEIGHT, 
            $quality
        );
    }
    
    /**
     * Resize and save image to specific dimensions
     */
    public static function resizeAndSaveImage($sourcePath, $destinationPath, $width, $height, $quality = 90)
    {
        // Get image info
        $imageInfo = getimagesize($sourcePath);
        if (!$imageInfo) {
            throw new \Exception('Invalid image file');
        }
        
        $sourceWidth = $imageInfo[0];
        $sourceHeight = $imageInfo[1];
        $mimeType = $imageInfo['mime'];

        // Create image resource from source
        switch ($mimeType) {
            case 'image/jpeg':
                $sourceImage = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $sourceImage = imagecreatefrompng($sourcePath);
                break;
            case 'image/gif':
                $sourceImage = imagecreatefromgif($sourcePath);
                break;
            case 'image/webp':
                $sourceImage = imagecreatefromwebp($sourcePath);
                break;
            default:
                throw new \Exception('Unsupported image type: ' . $mimeType);
        }

        if (!$sourceImage) {
            throw new \Exception('Failed to create image resource');
        }

        // Calculate crop dimensions to maintain aspect ratio and fit exactly
        $sourceRatio = $sourceWidth / $sourceHeight;
        $targetRatio = $width / $height;

        if ($sourceRatio > $targetRatio) {
            // Source is wider, crop the width
            $cropWidth = $sourceHeight * $targetRatio;
            $cropHeight = $sourceHeight;
            $cropX = ($sourceWidth - $cropWidth) / 2;
            $cropY = 0;
        } else {
            // Source is taller, crop the height
            $cropWidth = $sourceWidth;
            $cropHeight = $sourceWidth / $targetRatio;
            $cropX = 0;
            $cropY = ($sourceHeight - $cropHeight) / 2;
        }

        // Create new image with target dimensions
        $targetImage = imagecreatetruecolor($width, $height);
        
        if (!$targetImage) {
            imagedestroy($sourceImage);
            throw new \Exception('Failed to create target image');
        }
        
        // For PNG images, preserve transparency
        if ($mimeType === 'image/png') {
            imagealphablending($targetImage, false);
            imagesavealpha($targetImage, true);
            $transparent = imagecolorallocatealpha($targetImage, 255, 255, 255, 127);
            imagefill($targetImage, 0, 0, $transparent);
        }

        // Resize and crop
        $result = imagecopyresampled(
            $targetImage, $sourceImage,
            0, 0, $cropX, $cropY,
            $width, $height, $cropWidth, $cropHeight
        );

        if (!$result) {
            imagedestroy($sourceImage);
            imagedestroy($targetImage);
            throw new \Exception('Failed to resize image');
        }

        // Ensure destination directory exists
        $directory = dirname($destinationPath);
        if (!file_exists($directory)) {
            mkdir($directory, 0755, true);
        }

        // Save as JPEG with specified quality (default 90%)
        $saved = imagejpeg($targetImage, $destinationPath, $quality);

        // Clean up memory
        imagedestroy($sourceImage);
        imagedestroy($targetImage);

        if (!$saved) {
            throw new \Exception('Failed to save resized image');
        }

        return true;
    }
    
    /**
     * Generate a filename for profile picture
     */
    public static function generateProfilePictureFilename($userId, $prefix = 'profile')
    {
        return $prefix . '_' . $userId . '_' . time() . '.jpg';
    }
    
    /**
     * Get default profile picture dimensions
     */
    public static function getProfilePictureDimensions()
    {
        return [
            'width' => self::PROFILE_PICTURE_WIDTH,
            'height' => self::PROFILE_PICTURE_HEIGHT
        ];
    }
}