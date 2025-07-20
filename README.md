# sql-injection-demo
Demo of SQL injection vulnerability and prevention


# SQL Injection Demo

This repository demonstrates two PHP scripts:

- `insecure/` – A simple example vulnerable to SQL Injection.
- `secure/` – A secure version using prepared statements.

## 💾 Setup

1. Import this SQL into your database:
```sql
CREATE DATABASE test_db;
USE test_db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL
);

INSERT INTO users (username) VALUES ('admin'), ('john'), ('alice');
