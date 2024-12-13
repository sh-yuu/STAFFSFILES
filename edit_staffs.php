<?php
include ('..\assets\connect.php');
include ('staffs.php');

$employee = $_SESSION['employee_data'];


if (isset($_POST['save'])) {
    $id = (int)$employee['id'];
    $name = htmlspecialchars($_POST['name']);
    $age = (int)$_POST['age'];
    $sex = htmlspecialchars($_POST['sex']);
    $position = htmlspecialchars($_POST['position']);

    $sql = "UPDATE employees SET name = '$name', age = $age, sex = '$sex', position = '$position' WHERE id = $id" ;
    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = "Employee updated successfully!";
        unset($_SESSION['employee_data']);
        echo "<script>alert('Employee Updated Successfully');</script>";
        echo "<script>window.location.href='staffs.php'</script>";
    } else {
        $_SESSION['message'] = "Error updating employee: " . mysqli_error($conn);
    }

}
?>

<link rel="stylesheet" href="edit_staffs.css">
<script>
    function closeForm() {
        document.querySelector('.edit_wrapper').style.display = 'none';
        window.location.href="staffs.php";
    }
</script>

<script>

document.addEventListener('DOMContentLoaded', () => {
  const draggable = document.getElementById('dragIt');

  let offsetX = 0;
  let offsetY = 0;
  let isDragging = false;

  function startDrag(event) {
    isDragging = true;

    const clientX = event.type.includes('touch') ? event.touches[0].clientX : event.clientX;
    const clientY = event.type.includes('touch') ? event.touches[0].clientY : event.clientY;

    offsetX = clientX - draggable.offsetLeft;
    offsetY = clientY - draggable.offsetTop;
  }

  function drag(event) {
    if (!isDragging) return;

    const clientX = event.type.includes('touch') ? event.touches[0].clientX : event.clientX;
    const clientY = event.type.includes('touch') ? event.touches[0].clientY : event.clientY;

    let newLeft = clientX - offsetX;
    let newTop = clientY - offsetY;

    draggable.style.left = `${newLeft}px`;
    draggable.style.top = `${newTop}px`;
  }

  function endDrag() {
    isDragging = false;
  }

  // Event listeners
  ['mousedown', 'touchstart'].forEach(event => draggable.addEventListener(event, startDrag));
  ['mousemove', 'touchmove'].forEach(event => document.addEventListener(event, drag));
  ['mouseup', 'touchend'].forEach(event => document.addEventListener(event, endDrag));
});


    
</script>




<div class="edit_wrapper" id= "dragIt">
<div class="current_info_wrapper">
    
    <div>
    
    <div>
        <h2>Current Info:</h2>
    </div>

    <div>
        <h3>ID: <?php echo  $employee['id'] ?></h3>
    </div>

    <div>
        <h3>Name: <?php echo  $employee['name'] ?></h3>
    </div>

    <div>
        <h3>Age: <?php echo  $employee['age'] ?></h3>
    </div>

    <div>
        <h3>Sex: <?php echo  $employee['sex'] ?></h3>
    </div>

    <div>
        <h3>Position: <?php echo  $employee['position'] ?></h3>
    </div>
    
    </div>
    
    </div>
<div class="form_wrapper">
<form action= "" method="post">

    <div>
        <label for = "name">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/>
            </svg>
        </label>
        <input type="text" name="name" placeholder="Name" class="name_input" required>
    </div>

    <div>
        <label for = "age">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-arrow-down-up" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5m-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5"/>
            </svg>
        </label>
        <input type="number" name="age" placeholder="Age" class="age_input" required>
    </div>

    <div>
        <label for = "sex">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-gender-ambiguous" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.5 1a.5.5 0 0 1 0-1h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V1.707l-3.45 3.45A4 4 0 0 1 8.5 10.97V13H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V14H6a.5.5 0 0 1 0-1h1.5v-2.03a4 4 0 1 1 3.471-6.648L14.293 1zm-.997 4.346a3 3 0 1 0-5.006 3.309 3 3 0 0 0 5.006-3.31z"/>
            </svg>
        </label>
            <select name="sex" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
    </div>

    <div>
        <label for = "position">
        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-p-square-fill" viewBox="0 0 16 16">
  <path d="M8.27 8.074c.893 0 1.419-.545 1.419-1.488s-.526-1.482-1.42-1.482H6.778v2.97z"/>
  <path d="M2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm3.5 4.002h2.962C10.045 4.002 11 5.104 11 6.586c0 1.494-.967 2.578-2.55 2.578H6.784V12H5.5z"/>
</svg>
        </label>
        <select name="position" required>
              <option value="Manager">Manager</option>
              <option value="Cashier">Cashier</option>
              <option value="Waiter">Waiter</option>
              <option value="Chef">Chef</option>
              <option value="Dishwasher">Dishwasher</option>
              <option value="Head Chef">Head Chef</option>
        </select>
    </div>

    <div class="saveclose_wrapper">
        <button type="submit" name="save" class="editButtons">Save</button>
        <button class="editButtons" onclick="closeForm()">Close</button>
    </div> 


</div>
</form>

</div>