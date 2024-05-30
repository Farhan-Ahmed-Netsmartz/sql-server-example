Command to create table:
(

    CREATE TABLE registration (
    id INT IDENTITY(1,1) PRIMARY KEY, -- Auto-incrementing primary key
    firstName NVARCHAR(50) NOT NULL,
    lastName NVARCHAR(50) NOT NULL,
    gender NVARCHAR(10) NOT NULL,
    email NVARCHAR(100) NOT NULL,
    password NVARCHAR(255) NOT NULL, -- Storing passwords as NVARCHAR; consider using hashes in practice
    number NVARCHAR(15) NOT NULL -- Assuming phone numbers; adjust length as needed
    );


);
