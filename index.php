<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insecure Login (SQL Injection Vulnerable)</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f8f9fa, #e0e0e0);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 2rem 3rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.15);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 1rem;
            color: #dc3545;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 0.5rem;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #bd2130;
        }

        .message {
            margin-top: 1rem;
            font-weight: bold;
        }

        .success {
            color: green;
        }

        .fail {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Insecure Login</h2>
        <form method="GET" action="">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            <button type="submit">Check</button>
        </form>

        <?php
        if (isset($_GET['username'])) {
            $conn = new mysqli("localhost", "root", "", "test_db");

            if ($conn->connect_error) {
                die("<div class='message fail'>Connection failed: " . $conn->connect_error . "</div>");
            }

            $username = $_GET['username']; // Unsafe input
            $sql = "SELECT * FROM users WHERE username = '$username'";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                echo "<div class='message success'>✅ User exists!</div>";
            } else {
                echo "<div class='message fail'>❌ User not found.</div>";
            }

            $conn->close();
        }
        ?>
    </div>
</body>
</html>
