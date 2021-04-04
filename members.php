<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include_once("connections/connections.php");
    $con = connections();
    
    if(isset($_POST['submit'])){
        $fname = $_POST['firstname'];
        $lname = $_POST['lastname'];
        $gender = $_POST['gender'];

        $sql = "INSERT INTO `member_list`(`first_name`, `last_name`, `gender`) VALUES ('$fname', '$lname', '$gender')";
        $con->query($sql) or die ($con->error);
    }

    $sql = "SELECT * FROM `member_list`";
    $member = $con->query($sql) or die ($con->error);
    $row = $member->fetch_assoc();
    $total = $member->num_rows;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
    <title>Centralian Youth Club</title>
</head>
<body>
    <div class="home">
        <div class="upper-nav">
            <div class="greet">
                <?php if(isset($_SESSION['UserLogin'])){ ?>
                <?php echo "Welcome, ".$_SESSION['UserLogin']; ?>
                <?php } else { ?>
                <?php echo "Welcome Guest"; } ?>
            </div>
            <div class="login-box">
                <?php if(isset($_SESSION['UserLogin'])) { ?>
                    <button class="logout-button"><a href="logout.php">Logout</a></button>
                <?php } else { ?>
                    <button class="login-button"><a href="login.php">Login</a></button>
                <?php } ?>
            </div>
        </div>
        <nav>
          <ul class="navbar">
            <li><a href="index.php">Home</a></li>
            <li><a href="members.php">Members</a></li>
            <div class="relateUs">
            <li class="relatebut"><a href="#">Relate with Us<i class="fas fa-sort-down"></i></a></li>
                <ul class="relate-dropdown">
                    <li><a href="news.php">News</a></li>
                    <li><a href="suggestion.php">Suggestion</a></li>
                </ul>
            </div>
           
            <li><a href="aboutus.php">About Us</a></li>
          </ul>
        </nav>
        <!-- Member Content -->
        <div class="member-content">
            <div class="member-title">
                <h1>Member List</h1>
            </div>

            <div class="upper-table">
                <div class="upper-button">
                    <?php if(isset($_SESSION['UserLogin'])){ ?>
                        <button class="add-member">Add Member</button>
                    <?php } else { ?>
                        <button style="visibility: hidden" class="add-member"></button>
                    <?php } ?>
                </div>
                <div class="numbers">
                    <p>As of now, we have <strong><?php echo $total ?></strong> members</p>
                </div>
                <div class="search">
                    <form action="result.php" method="post">
                        <input type="text" name="search" id="search" autocomplete="off">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>First Name</th>
                        <th>Last Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php do {?>
                    <tr>
                        <?php if(isset($_SESSION['UserLogin'])){ ?>
                            <td class="first-data"><button class="view-button"><a href="detailsmem.php?ID=<?php echo $row['id']; ?>">view</a></button></td>
                        <?php } else { ?>
                            <td class="first-data"><p><?php echo $row['id']; ?></p></td>
                        <?php } ?>
                        <td><?php echo $row['first_name']; ?></td>
                        <td><?php echo $row['last_name']; ?></td>
                    </tr>
                    <?php }while($row = $member->fetch_assoc()); ?>
                </tbody>
            </table>
    </div>

    <!-- Add new Modal -->
    <div class="addNew-modal">
        <div class="addNew-form">
                <h1>Add Member Form</h1>
            <form action="" method="post">
                <label for="">First Name:</label>
                <input type="text" name="firstname" id="firstname" autocomplete="off" required>
                <label for="">Last Name</label>
                <input type="text" name="lastname" id="lastname" autocomplete="off" required>
                <label for="">Gender</label>
                <select name="gender" id="gender">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                </select>
                <input type="submit" name="submit" value="Add to the list">
            </form>
            <div class="close-addnew">
                <p>X</p>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
</body>
</html>