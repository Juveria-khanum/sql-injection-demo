<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Secure Login (SQL Injection Safe)</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #f0f2f5, #dce3ea);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background: white;
            padding: 2rem 3rem;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0,0,0,0.1);
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        h2 {
            margin-bottom: 1rem;
            color: #28a745;
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
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #218838;
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
        <h2>Secure Login</h2>
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

            $username = $_GET['username'];

            // Secure version using prepared statements
            $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                echo "<div class='message success'>✅ User exists!</div>";
            } else {
                echo "<div class='message fail'>❌ User not found.</div>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
</body>
</html>
