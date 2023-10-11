<?php
// Your log file here:
$logFile = '/var/log/auth.log';
$logData = file_get_contents($logFile);
function replaceIPWithLink($matches): string
{
    $ip = $matches[0];
    $link = "https://whatismyipaddress.com/ip/$ip";
    return "<a class='ip-link cursor-pointer hover:bg-blue-400 underline' target='popup' onclick=\"window.open('$link','popup','width=600,height=600'); return false;\">$ip</a>";
}

// Replace IP addresses with links in the log data
$logData = preg_replace_callback('/\b\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\b/', 'replaceIPWithLink', $logData);


if (isset($_GET['keyword']) && !empty($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $lines = explode(PHP_EOL, $logData);

    $filteredLines = array_filter($lines, function ($line) use ($keyword) {
        return stripos($line, $keyword) !== false;
    });

    $filteredLogData = implode(PHP_EOL, $filteredLines);
    if (!empty($filteredLogData)) {
        $filteredLogData = preg_replace('/' . preg_quote($keyword, '/') . '/i', '<mark>' . $keyword . '</mark>', $filteredLogData);
        echo "<pre>$filteredLogData</pre>";
    } else {
        echo "<p>No matching lines found.</p>";
    }
} else {
    echo "<pre>$logData</pre>";
}
?>
