#The remediation involved refactoring the database interaction to use Prepared Statements. This separates the query structure from the data. The SQL logic is pre-compiled, and user input is strictly bound as string parameters ("ss"), preventing any injected SQL commands from being executed

// Retrieve user input
$input_uname = $_GET['username'];
$input_pwd = $_GET['Password'];
$hashed_pwd = hash('sha512', $input_pwd);

// SECURE: Use Prepared Statements
// The '?' placeholders prevent SQL injection
$stmt = $conn->prepare("SELECT id, name, eid, salary, birthday, ssn, phone, address, email, nickname, password 
                        FROM pii 
                        WHERE name = ? and Password = ?");

// Bind parameters as strings ("ss")
$stmt->bind_param("ss", $input_uname, $hashed_pwd);

// Execute the prepared statement
$stmt->execute();
$result = $stmt->get_result();
