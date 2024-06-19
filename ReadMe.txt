Task 1:
1. Create a table :
CREATE TABLE users ( id INT AUTO_INCREMENT PRIMARY KEY,

        name VARCHAR(255) NOT NULL,

        email VARCHAR(255) NOT NULL UNIQUE,

        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);

2. Go to project_folder/task1/




Task 2 :

1. Create a table :
CREATE TABLE users_table (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    username VARCHAR(255) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
2. Go to project_folder/task2/public/






Task 3:
1. Download the Postman collection from https://drive.google.com/file/d/1HQ--XitgtPV9wHcSZhPaDNtwEcuvMI-E/view?usp=sharing
2. Change local URL as per your Local Machine.
