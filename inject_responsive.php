<?php

/**
 * ISBN YPIK PAM JAYA - Responsive Script Injector
 * Recursively scans resources/views and injects responsive CSS/JS links.
 */

$viewsDir = __DIR__ . '/resources/views';
$injectedCount = 0;
$skippedCount = 0;
$errorCount = 0;

function injectResponsiveIntoViews($dir) {
    global $injectedCount, $skippedCount, $errorCount;
    
    $items = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS),
        RecursiveIteratorIterator::SELF_FIRST
    );
    
    foreach ($items as $item) {
        if ($item->isFile() && $item->getExtension() === 'php' && strpos($item->getFilename(), '.blade.php') !== false) {
            $filePath = $item->getRealPath();
            $content = file_get_contents($filePath);
            
            // Check if already injected
            if (strpos($content, 'css/responsive.css') !== false || strpos($content, 'js/responsive.js') !== false) {
                echo "[SKIPPED] Already has responsive links: " . $item->getFilename() . "\n";
                $skippedCount++;
                continue;
            }
            
            // Locate </head> tag (case-insensitive)
            $pos = strripos($content, '</head>');
            
            if ($pos !== false) {
                $injection = "\n    <!-- Custom Global Responsive Design -->\n";
                $injection .= "    <link rel=\"stylesheet\" href=\"{{ asset('css/responsive.css') }}\">\n";
                $injection .= "    <script src=\"{{ asset('js/responsive.js') }}\" defer></script>\n";
                
                // Insert links right before </head>
                $newContent = substr($content, 0, $pos) . $injection . substr($content, $pos);
                
                if (file_put_contents($filePath, $newContent) !== false) {
                    echo "[SUCCESS] Injected responsive links into: " . $item->getFilename() . "\n";
                    $injectedCount++;
                } else {
                    echo "[ERROR] Failed to write file: " . $item->getFilename() . "\n";
                    $errorCount++;
                }
            } else {
                echo "[WARNING] No </head> tag found in: " . $item->getFilename() . " (skipping)\n";
                $errorCount++;
            }
        }
    }
}

echo "=== STARTING INJECTION PROCESS ===\n";
if (is_dir($viewsDir)) {
    injectResponsiveIntoViews($viewsDir);
    echo "\n=== INJECTION SUMMARY ===\n";
    echo "Successfully injected: $injectedCount file(s)\n";
    echo "Skipped (already injected): $skippedCount file(s)\n";
    echo "Warnings/Errors (no </head> tag or write error): $errorCount file(s)\n";
} else {
    echo "[ERROR] Views directory does not exist: $viewsDir\n";
}
