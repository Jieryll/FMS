<?php

include('../Mysql/connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = isset($_POST["firstname"]) ? trim($_POST["firstname"]) : null;
    $middlename = isset($_POST["middlename"]) ? trim($_POST["middlename"]) : null;
    $lastname = isset($_POST["lastname"]) ? trim($_POST["lastname"]) : null;
    $number = isset($_POST["number"]) ? trim($_POST["number"]) : null;
    $username = isset($_POST["username"]) ? trim($_POST["username"]) : null;
    $password = isset($_POST["password"]) ? trim($_POST["password"]) : null;
    $status = "offline";
    $type = "User";

    if (!empty($firstname) && !empty($middlename) && !empty($lastname) && !empty($number) && !empty($username) && !empty($password)) {
        $select = "SELECT * FROM farmer_list WHERE firstname=? AND middle=? AND lastname=? AND number=?";
        $stmt = $conn->prepare($select);
        $stmt->bind_param("ssss", $firstname, $middlename, $lastname, $number);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 0) {
            echo "<script>alert('Not found. Try again.');
            location.href='signin.php';
            </script>";
        } else {
            $select = "SELECT * FROM accounts WHERE number=? OR username=?";
            $stmt = $conn->prepare($select);
            $stmt->bind_param("ss", $number, $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $existing = $result->fetch_assoc();
                if ($existing['number'] == $number) {
                    echo "<script>alert('" . $number . " is already in use.'); window.location.href='signin.php';</script>";
                } elseif ($existing['username'] == $username) {
                    echo "<script>alert('" . $username . " is already in use.'); window.location.href='signin.php';</script>";
                }
            } else {
                $sql = "INSERT INTO accounts (firstname, middle, lastname, number, username, password, statuss, time_created, type) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssssssss", $firstname, $middlename, $lastname, $number, $username, $password, $status, $type);

                if ($stmt->execute()) {
                    echo "<script>alert('Registration successful'); window.location.href='../index.php';</script>";
                } else {
                    echo "<script>alert('Error during registration'); window.location.href='../index.php';</script>";
                }
            }
        }
        $stmt->close();
    } else {
       
    }
}
?>

    <div id="sp" class="sp_container">
        <form method="POST">
        
                <div class="form-container">
                    <div class="align">
                        <div>
                            <span class="closez"><a href="../index.php" >&times;</a></span>
                        </div>
                        <div>
                            <h1>Register</h1>
                        </div>
                        <div>
                            <p></p>
                        </div>
                    </div>
                
                    <div id="register-form">
                        <div>
                            <div class="input-field">
                                <div>
                                    <label >First Name <p class="error" id="errorFirstname"></p></label>
                                    <input type="text" id="firstname" placeholder="First Name"  name="firstname" onblur="verifyFirstName()" required>
                                </div>
                            </div>
                            <div class="input-field">
                                <div>
                                    <label>Middle N. <p class="error" id="errorMiddlename"></p></label>
                                    <input type="text"  id="middle" placeholder="Middle Name" name="middlename" onblur="verifyMiddleName()" required>
                                
                                </div>
                            </div>
                            <div class="input-field">
                                <div>
                                    <label>Last Name <p class="error" id="errorLastname"></p></label>
                                    <input type="text" id="lastname" placeholder="Last Name" name="lastname" onblur="verifyLastName()" required>
                                    
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="input-field">
                                <div>
                                    <label>Number <p class="error" id="errorNumber"></p></label>
                                    <input type="text" maxlength="11" placeholder="Number" id="number" name="number" onblur="verifyNumber()" required>
                                </div>
                            </div>
                            <div class="input-field">
                                <div>
                                    <label>Username <p class="error" id="error1"></p></label>
                                    <input type="text" placeholder="UserName" id="username" name="username" required>
                                    
                                </div>
                            </div>
                            <div class="input-field">
                                <div>
                                    <label>Password <p class="error" id="error1"></p></label>
                                    <input type="password" placeholder="Password" id="password" name="password" required>
                                
                                </div>

                            </div>
                        </div>
                    </div>
                    <button id="next-btn" type="submit" >Confirm</button>
                    <a href="../index.php" style="text-decoration: none; color: black; margin-top: 20px;">Have an account? Login</a>
                </div>
        </form>
    </div>
    <style>
    #sp {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background-color: rgba(0, 0, 0, 0.4);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .form-container {
        background-color: #28a745; 
        border-radius: 20px;
        padding: 20px;
        width: 100%;
        box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        display:flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }
    #register-form {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: row;
        gap: 15px;
        width: 100%;
    }

    .input-field {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .input-field label {
        font-size: 18px;
        font-weight: bold;
        color: black;
    }

    .input-field input {
        padding: 10px;
        border: none;
        border-radius: 5px;
        width: 100%;
        font-size: 16px;
    }

    button {
        background-color: white;
        color: #28a745;
        padding: 10px 20px;
        border: none;
        border-radius: 10px;
        font-size: 18px;
        font-weight: bold;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
        transition: background-color 0.3s;
    }

    button:hover {
        background-color: #ddd;
    }

    .error {
        color: red;
        font-size: 12px;
        margin: 5px 0 0;
    }
    .align{
        display: flex;
        align-items:center;
        justify-content: space-between;
        gap: 155px;
    }
    .closez{
        font-size: 30px;
        color: black;
        font-weight:bold ;
        cursor: pointer;
    }
    a{
        text-decoration: none;
        color: black;
    }
</style>