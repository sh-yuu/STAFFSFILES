<?php

require_once('..\assets\connect.php');
session_start();

$query = "SELECT * from employees";
$result = mysqli_query($conn, $query);

?>
<?php
// Add Employee
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $sex = $_POST['sex'];
    $position = $_POST['position'];

    $sql = "INSERT INTO employees (name, age, sex, position) VALUES (?, ?, ?, ?)";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'siss', $name, $age, $sex, $position); // Binding parameters
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Employee Added Successfully')</script>";
        } else {
            echo "<script>alert('Failed to add employee')</script>";
        }
        mysqli_stmt_close($stmt);
    }
    echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "';</script>";
    exit;
}

// Edit Employee (redirect to edit page)
if (isset($_POST['edit'])) {
    $_SESSION['employee_data'] = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'age' => $_POST['age'],
        'sex' => $_POST['sex'],
        'position' => $_POST['position']
    ];
    header("Location: edit_staffs.php");
    exit;
}

// Delete Employee
if (isset($_POST['delete'])) {
    $id = $_POST['id']; // Get the ID of the employee to be deleted
    $sql = "DELETE FROM employees WHERE id = ?";
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $id); // Bind ID as integer
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Employee Deleted Successfully')</script>";
        } else {
            echo "<script>alert('Failed to delete employee')</script>";
        }
        mysqli_stmt_close($stmt);
    }
    echo "<script>window.location.href = '" . $_SERVER['PHP_SELF'] . "';</script>";
    exit;
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Employees</title>
    <link rel="stylesheet" href="staffs_admin.css">
    <script src="../assets/links.js" defer></script>
</head>

<body onload="table();">

    <nav >
    
    <div class="logo_wrapper">
        <img src="../assets/logo_processed.png" alt="AoLogo">
    </div>
                
    <div class="customer_acc_wrapper" onclick="redirect(this)">
     <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="100%" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
      <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
     </svg>
        <h1>Accounts</h1>
    </div>
    
    <div class="product_wrapper" onclick="redirect(this)">
     <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="100%" fill="currentColor" class="bi bi-tag-fill" viewBox="0 0 16 16">
      <path d="M2 1a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l4.586-4.586a1 1 0 0 0 0-1.414l-7-7A1 1 0 0 0 6.586 1zm4 3.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
    </svg>
        <h1>Product</h1>
    </div>
    
    <div class="staffs_wrapper" onclick="redirect(this)">
    
    <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="100%" fill="currentColor" class="bi bi-person-badge" viewBox="0 0 16 16">
      <path d="M6.5 2a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1zM11 8a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
     <path d="M4.5 0A2.5 2.5 0 0 0 2 2.5V14a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2.5A2.5 2.5 0 0 0 11.5 0zM3 2.5A1.5 1.5 0 0 1 4.5 1h7A1.5 1.5 0 0 1 13 2.5v10.795a4.2 4.2 0 0 0-.776-.492C11.392 12.387 10.063 12 8 12s-3.392.387-4.224.803a4.2 4.2 0 0 0-.776.492z"/>
    </svg>
        <h1>Staffs</h1>
    </div>
    
    <div class="transaction_wrapper" onclick="redirect(this)">
     <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="100%" fill="currentColor" class="bi bi-cash-coin" viewBox="0 0 16 16">
       <path fill-rule="evenodd" d="M11 15a4 4 0 1 0 0-8 4 4 0 0 0 0 8m5-4a5 5 0 1 1-10 0 5 5 0 0 1 10 0"/>
       <path d="M9.438 11.944c.047.596.518 1.06 1.363 1.116v.44h.375v-.443c.875-.061 1.386-.529 1.386-1.207 0-.618-.39-.936-1.09-1.1l-.296-.07v-1.2c.376.043.614.248.671.532h.658c-.047-.575-.54-1.024-1.329-1.073V8.5h-.375v.45c-.747.073-1.255.522-1.255 1.158 0 .562.378.92 1.007 1.066l.248.061v1.272c-.384-.058-.639-.27-.696-.563h-.668zm1.36-1.354c-.369-.085-.569-.26-.569-.522 0-.294.216-.514.572-.578v1.1zm.432.746c.449.104.655.272.655.569 0 .339-.257.571-.709.614v-1.195z"/>
       <path d="M1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4.083q.088-.517.258-1H3a2 2 0 0 0-2-2V3a2 2 0 0 0 2-2h10a2 2 0 0 0 2 2v3.528c.38.34.717.728 1 1.154V1a1 1 0 0 0-1-1z"/>
       <path d="M9.998 5.083 10 5a2 2 0 1 0-3.132 1.65 6 6 0 0 1 3.13-1.567"/>
    </svg>
        <h1>Transactions</h1>
    </div>
    
    <div class="settings_wrapper" onclick="redirect(this)">
    
    <svg xmlns="http://www.w3.org/2000/svg"  width="50%" height="100%" fill="currentColor" class="bi bi-gear-fill" viewBox="0 0 16 16">
     <path d="M9.405 1.05c-.413-1.4-2.397-1.4-2.81 0l-.1.34a1.464 1.464 0 0 1-2.105.872l-.31-.17c-1.283-.698-2.686.705-1.987 1.987l.169.311c.446.82.023 1.841-.872 2.105l-.34.1c-1.4.413-1.4 2.397 0 2.81l.34.1a1.464 1.464 0 0 1 .872 2.105l-.17.31c-.698 1.283.705 2.686 1.987 1.987l.311-.169a1.464 1.464 0 0 1 2.105.872l.1.34c.413 1.4 2.397 1.4 2.81 0l.1-.34a1.464 1.464 0 0 1 2.105-.872l.31.17c1.283.698 2.686-.705 1.987-1.987l-.169-.311a1.464 1.464 0 0 1 .872-2.105l.34-.1c1.4-.413 1.4-2.397 0-2.81l-.34-.1a1.464 1.464 0 0 1-.872-2.105l.17-.31c.698-1.283-.705-2.686-1.987-1.987l-.311.169a1.464 1.464 0 0 1-2.105-.872zM8 10.93a2.929 2.929 0 1 1 0-5.86 2.929 2.929 0 0 1 0 5.858z"/>
    </svg>
        <h1>Settings</h1>
    </div>
    
    <div class="signout_wrapper">
       <button>
       <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="50%" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
         <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0z"/>
         <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708z"/>
        </svg> 
          Sign Out
       </button>
    </div>
    
    </nav>


    <main>
        <div class="page_title">
            <h1>Employees</h1>

        </div>
        <div class="content_wrapper">
           <div>
           <form id="form_add" action="" method="post" enctype="multipart/form-data">

            <div class="productname_wrapper">
                <label for = "name">Name:</label>
                <input type="text" name="name" placeholder="Name" required>
            </div>

            <div class="price_wrapper">
            <label for = "age">Age:</label>
                <input type="number" name="age" placeholder="Age" required>
            </div>

            <div class="option_wrapper">
            <label for = "sex">Sex:</label>
            <select name="sex" required>
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>
            </div>

            <div class="option_wrapper">
            <label for = "position">Position:</label>
            <select name="position" required>
              <option value="Manager">Manager</option>
              <option value="Cashier">Cashier</option>
              <option value="Waiter">Waiter</option>
              <option value="Chef">Chef</option>
              <option value="Dishwasher">Dishwasher</option>
              <option value="Head Chef">Head Chef</option>
            </select>
            </div>

            <div class="submit_wrapper">
            <input type="submit" value="Add Employee" name="add" >
            </div> 


            </form>


            <table border="0" class="choice_content" id="contents">

            </table>
           </div>

        </div>

      

    </main>


<script>

function table(){

  const xhr = new XMLHttpRequest();
  xhr.onload = function () {
    document.getElementById("contents").innerHTML = this.responseText;
  };
  xhr.open("POST", "staffs_table.php", true);
  xhr.send();
}

  setInterval(function(){table();}, 1000);

</script>

</body>

</html>
