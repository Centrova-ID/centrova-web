<?php

require_once 'vendor/autoload.php';

use App\Helpers\AvatarHelper;

// Test data
$testCases = [
    'assets/illustrations/universal/test.jpg',
    'profile-pictures/profile_1_1756652414.jpg',
    'avatars/user_123_1234567890.jpg',
    'hashed:abc123_def456',
    'https://example.com/avatar.jpg',
    null,
    ''
];

echo "Testing Avatar URL Resolution\n";
echo "==============================\n\n";

foreach ($testCases as $input) {
    echo "Input: " . ($input ?? 'null') . "\n";
    
    try {
        $output = AvatarHelper::resolveAvatarUrl($input);
        echo "Output: " . ($output ?? 'null') . "\n";
        
        // Check if it's a blob-like URL
        if ($output && str_contains($output, '/avatar/hashed/')) {
            echo "✅ Blob-style URL generated\n";
        } elseif ($output && str_starts_with($output, 'http')) {
            echo "ℹ️  External URL preserved\n";
        } elseif ($output === null) {
            echo "ℹ️  Null input handled correctly\n";
        } else {
            echo "⚠️  Standard storage URL\n";
        }
        
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
}

echo "Testing Profile Picture Types\n";
echo "==============================\n\n";

foreach ($testCases as $input) {
    echo "Input: " . ($input ?? 'null') . "\n";
    
    try {
        $isIllustration = AvatarHelper::isIllustration($input);
        echo "Is Illustration: " . ($isIllustration ? 'Yes' : 'No') . "\n";
        
    } catch (Exception $e) {
        echo "❌ Error: " . $e->getMessage() . "\n";
    }
    
    echo "\n";
}
