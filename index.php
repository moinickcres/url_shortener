<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple URL Shortener</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .form-container {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        input[type="url"], input[type="submit"] {
            padding: 10px;
            margin: 10px 0;
            width: 100%;
            box-sizing: border-box;
        }
        .result {
            margin-top: 20px;
            font-weight: bold;
            color: green;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>URL Shortener</h1>
        <form id="urlForm">
            <label for="url">Enter a URL to shorten:</label>
            <input type="url" id="url" name="url" placeholder="https://example.com" required>
            <input type="submit" value="Shorten URL">
        </form>
        <div class="result" id="result"></div>
    </div>

    <script>
        document.getElementById('urlForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const urlInput = document.getElementById('url').value;
            const formData = new FormData();
            formData.append('url', urlInput);

            fetch('shorten.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                const resultDiv = document.getElementById('result');
                if (data.short_url) {
                    resultDiv.innerHTML = `Short URL: <a href="${data.short_url}">${data.short_url}</a>`;
                } else if (data.error) {
                    resultDiv.innerHTML = `Error: ${data.error}`;
                }
            });
        });
    </script>
</body>
</html>
