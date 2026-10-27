//this php code

$connection = new mysqli("localhost", "root", "root","horizon_bank");

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
} else {
    echo "MySQL connected successfully.\n";
}


$sql = "CREATE DATABASE IF NOT EXISTS horizon_bank";

if ($connection->query($sql) === TRUE) {
    echo "Database created successfully.\n";
} else {
    die("Database error: " . $connection->error);
}

$connection->select_db("horizon_bank");

// 3. Create Customer table
$sql = "CREATE TABLE IF NOT EXISTS Customer (
    Customer_ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(50),
    Age INT,
    Gender VARCHAR(10),
    Contact VARCHAR(15),
    Email VARCHAR(100),
    Address VARCHAR(100)
)";

if ($connection->query($sql)) {
    echo "Customer table created successfully.\n";
} else {
    die("Customer table error: " . $connection->error);
}

// 4. Create Employee table
$sql = "CREATE TABLE IF NOT EXISTS Employee (
    Employee_ID INT PRIMARY KEY AUTO_INCREMENT,
    Name VARCHAR(50),
    Designation VARCHAR(50),
    Contact VARCHAR(15),
    Salary DECIMAL(10,2)
)";

if ($connection->query($sql)) {
    echo "Employee table created successfully.\n";
} else {
    die("Employee table error: " . $connection->error);
}

// 5. Create Bank table
$sql = "CREATE TABLE IF NOT EXISTS Bank (
    Bank_ID INT PRIMARY KEY AUTO_INCREMENT,
    Bank_Name VARCHAR(100),
    Branch VARCHAR(100),
    IFSC_Code VARCHAR(20)
)";

if ($connection->query($sql)) {
    echo "Bank table created successfully.\n";
} else {
    die("Bank table error: " . $connection->error);
}

// 6. Create Transactions table
$sql = "CREATE TABLE IF NOT EXISTS Transactions (
    Transaction_ID INT PRIMARY KEY AUTO_INCREMENT,
    Customer_ID INT,
    Bank_ID INT,
    Transaction_Type VARCHAR(10),
    Amount DECIMAL(10,2),
    Transaction_Date DATE
)";

if ($connection->query($sql)) {
    echo "Transactions table created successfully.\n";
} else {
    echo "Transactions table error: "
         . $connection->error . "\n";
}


$sql = "INSERT INTO Customer
(Name, Age, Gender, Contact, Email, Address)VALUES
('Raja Sharma', 30, 'Male', '9876500001','raja@example.com', 'Virar'),
('Neha Sharma', 28, 'Female', '9876500002','neha@example.com', 'Mumbai')";

if ($connection->query($sql)) {
    echo "Customer records inserted successfully.\n";
} else {
    echo "Customer insert error: " . $connection->error . "\n";
}

$sql = "INSERT INTO Employee(Name, Designation, Contact, Salary)VALUES
('Raja Sharma', 'Manager', '9876500001', 50000),
('Neha Sharma', 'Cashier', '9876500002', 30000),
('Amit Verma', 'Accountant', '9876500003', 35000),
('Priya Singh', 'Loan Officer', '9876500004', 40000),
('Rahul Yadav', 'Customer Service', '9876500005', 28000)";

if ($connection->query($sql)) {
    echo "Employee records inserted successfully.\n";
} else {
    echo "Employee insert error: " . $connection->error . "\n";
}

$sql = "INSERT INTO Bank(Bank_Name, Branch, IFSC_Code)VALUES ('Horizon Bank', 'Virar Branch', 'FHPM0001234')";

if ($connection->query($sql)) {
    echo "Bank record inserted successfully.\n";
} else {
    echo "Bank insert error: " . $connection->error . "\n";
}


$sql = "INSERT INTO Transactions(Customer_ID, Bank_ID, Transaction_Type, Amount, Transaction_Date)VALUES
(1, 1, 'CREDIT', 5000, '2026-10-20'),
(2, 1, 'DEBIT', 1000, '2026-10-21')";

if ($connection->query($sql)) {
    echo "Transactions inserted successfully.\n";
} else {
    echo "Transaction insert error: " . $connection->error . "\n";
}


$sql = "UPDATE Customer
        SET Address = 'Vasai'
        WHERE Customer_ID = 1";

if ($connection->query($sql)) {
    echo "Customer address updated successfully.\n";
} else {
    echo "Update error: " . $connection->error . "\n";
}


$tables = ["Customer", "Employee", "Bank", "Transactions"];

foreach ($tables as $table) {
    echo   $table . " Records";

    $sql = "SELECT * FROM `$table`";
    $result = $connection->query($sql);

    if ($result) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                foreach ($row as $column => $value) {
                    echo $column . ": " . $value . "\n";
                }

             
            }
        } else {
            echo "No records found.\n";
        }
    } else {
        echo "Select error: " . $connection->error . "\n";
    }
}


$select = "SELECT * FROM Customer WHERE Customer_ID = ?";

$id = 4 ;

$result = $connection->execute_query($select, [$id]);

if ($row = $result->fetch_assoc()) {
    print_r($row);
} else {
    echo "No such data found.";
}

foreach ($row as $column => $value) {
    echo $column . ": " . $value . "\n";
}



// 13. Close connection
$connection->close();

echo "Database connection closed.";