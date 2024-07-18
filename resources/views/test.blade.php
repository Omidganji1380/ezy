<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticky Header and Footer with Scrollable Content</title>
    {{--    <link rel="stylesheet" href="styles.css">--}}
    <style>
        * {
            margin     : 0;
            padding    : 0;
            box-sizing : border-box;
        }

        html, body {
            height : 100%;
        }

        .container {
            display        : flex;
            flex-direction : column;
            height         : 100%;
        }

        .header {
            background-color : #f8f8f8;
            padding          : 10px;
            text-align       : center;
            position         : sticky;
            top              : 0;
            z-index          : 1000;
        }

        .footer {
            background-color : #f8f8f8;
            padding          : 10px;
            text-align       : center;
            position         : sticky;
            bottom           : 0;
            z-index          : 1000;
        }

        .content {
            flex       : 1;
            overflow-y : auto;
            padding    : 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <header class="header">
        <h1>Header</h1>
    </header>
    <main class="content">
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <p>Your scrollable content goes here...</p>
        <!-- Add more content here to make it scrollable -->
    </main>
    <footer class="footer">
        <p>Footer</p>
    </footer>
</div>
</body>
</html>
