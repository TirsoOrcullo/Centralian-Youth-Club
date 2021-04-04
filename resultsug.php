<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include_once("connections/connections.php");
    $con = connections();
    
    if(isset($_POST['submitsuggestion'])){
        $suggestiontitle = $_POST['suggestiontitle'];
        $sender = $_POST['sender'];
        $suggestion_details = $_POST['suggestiondetails'];

        $sql = "INSERT INTO `suggestion_list`(`suggestion_title`, `sender`, `suggestion_details`) VALUES ('$suggestiontitle', '$sender', '$suggestion_details')";
        $con->query($sql) or die ($con->error);
    }

    $search = $_POST['search'];

    $sql = "SELECT * FROM `suggestion_list` WHERE suggestion_title LIKE '%$search%' || sender LIKE '%$search%'";
    $suggestion = $con->query($sql) or die ($con->error);
    $row = $suggestion->fetch_assoc();
    $total = $suggestion->num_rows;

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
                    <li><a href="#">Suggestion</a></li>
                </ul>
            </div>
           
            <li><a href="#">About Us</a></li>
          </ul>
        </nav>
        <!-- Member Content -->
        <div class="member-content">
            <div class="member-title">
                <h1>Suggestion List</h1>
            </div>

            <div class="upper-table">
                <div class="upper-button">
                    <button class="add-member">Add Suggestion</button>
                </div>
                <div class="numbers">
                    <p>Total of <strong><?php echo $total ?></strong> News</p>
                </div>
                <div class="search">
                    <form action="resultsug.php" method="post">
                        <input type="text" name="search" id="search" autocomplete="off">
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Suggestion Title</th>
                        <th>Sender</th>
                    </tr>
                </thead>
                <tbody>
                    <?php do {?>
                    <tr>
                        <td class="first-data"><button class="view-button"><a href="detailssug.php?ID=<?php echo $row['id']; ?>">view</a></button></td>
                        <td><?php echo $row['suggestion_title']; ?></td>
                        <td><?php echo $row['sender']; ?></td>
                    </tr>
                    <?php }while($row = $suggestion->fetch_assoc()); ?>
                </tbody>
            </table>
    </div>

    <!-- Add new Modal -->
    <div class="addNew-modal">
        <div class="addNew-form">
                <h1>Suggestion Form</h1>
            <form action="" method="post">
                <label for="">Suggestion Title</label>
                <input type="text" name="suggestiontitle" id="suggestiontitle" autocomplete="off" required>
                <label for="">Sender</label>
                <input type="text" name="sender" id="sender">
                <label for="">Suggest:</label>
                <textarea name="suggestiondetails" id="suggestiondetails"></textarea>
                <input type="submit" name="submitsuggestion" value="Submit">
            </form>
            <div class="close-addnew">
                <p>X</p>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
</body>
</html>