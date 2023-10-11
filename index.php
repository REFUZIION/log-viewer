<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Log Viewer</title>
</head>
<body class="bg-gray-100 p-4">
<div class="container mx-auto bg-white p-4 rounded shadow">
    <h1 class="text-2xl font-bold mb-4">Log Viewer</h1>
    <div class="mb-4">
        <label for="keyword" class="block font-semibold">Filter by Keyword:</label>
        <input type="text" id="keyword" class="w-full border rounded p-2" placeholder="Enter a keyword" onkeyup="fetchLogData()">
    </div>
    <div id="log-container" class="border rounded p-4 overflow-y-auto max-h-[50vh] s:max-h-[80vh]">

    </div>
</div>
<script>
    function fetchLogData() {
        const keywordInput = document.getElementById('keyword');
        const keyword = keywordInput.value;
        const logContainer = document.getElementById('log-container');

        // Use the Fetch API to load log data without page reload
        fetch(`/auth/fetch-auth-log.php?keyword=${keyword}`)
            .then(response => response.text())
            .then(data => {
                logContainer.innerHTML = `${data}`;
            })
            .catch(error => console.error(error));
    }

    fetchLogData();
</script>
</body>
</html>
