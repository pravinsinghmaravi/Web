## Setting Up the Lab


## Create Database and Table Locally

```
create database sqli_db;
```

```
use sqli_db;
```

```
CREATE TABLE users (
id INT AUTO_INCREMENT PRIMARY KEY, 
username VARCHAR(50) NOT NULL UNIQUE, 
email VARCHAR(100) NOT NULL UNIQUE, 
password VARCHAR(255) NOT NULL,
enable TINYINT (1) NOT NULL DEFAULT 1
);
```

## About  the Files
