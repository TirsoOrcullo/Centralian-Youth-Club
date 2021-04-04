<?php 
    if(!isset($_SESSION)){
        session_start();
    }

    include_once("connections/connections.php");
    $con = connections();
    
    if(isset($_POST['submitnews'])){
        $newstitle = $_POST['newstitle'];
        $newsfor = $_POST['newsfor'];
        $newsdetails = $_POST['newsdetails'];

        $sql = "INSERT INTO `news_list`(`news_title`, `news_for`, `news_details`) VALUES ('$newstitle', '$newsfor', '$newsdetails')";
        $con->query($sql) or die ($con->error);
    }

    $search = $_POST['search'];

    $sql = "SELECT * FROM `news_list` WHERE news_title LIKE '%$search%' || news_for LIKE '%$search%'";
    $news = $con->query($sql) or die ($con->error);
    $row = $news->fetch_assoc();
    $total = $news->num_rows;

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
           
            <li><a href="#">About Us</a></li>
          </ul>
        </nav>
        <!-- Member Content -->
        <div class="member-content">
            <div class="member-title">
                <h1>News List</h1>
            </div>

            <div class="upper-table">
                <div class="upper-button">
                    <?php if(isset($_SESSION['UserLogin'])) { ?>
                        <button class="add-member">Add News</button>
                    <?php } else { ?>
                        <button style="display: none" class="add-member">Add News</button>
                    <?php } ?>
                </div>
                <div class="numbers">
                    <p>Total of <strong><?php echo $total ?></strong> Suggestion</p>
                </div>
                <div class="search">
                    <form action="resultnews.php" method="post">
                        <input type="text" name="search" id="search" >
                        <button type="submit">Search</button>
                    </form>
                </div>
            </div>

            <!-- Table -->
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th>Date/Time</th>
                        <th>News Title</th>
                        <th>News For</th>
                    </tr>
                </thead>
                <tbody>
                    <?php do {?>
                    <tr>
                        <td class="first-data"><button class="view-button"><a href="detailsnews.php?ID=<?php echo $row['id']; ?>">view</a></button></td>
                        <td><?php echo $row['news_addedat']; ?></td>
                        <td><?php echo $row['news_title']; ?></td>
                        <td><?php echo $row['news_for']; ?></td>
                    </tr>
                    <?php }while($row = $news->fetch_assoc()); ?>
                </tbody>
            </table>
    </div>

    <!-- Add new Modal -->
    <div class="addNew-modal">
        <div class="addNew-form">
                <h1>Add News Form</h1>
            <form action="" method="post">
                <label for="">News Title</label>
                <input type="text" name="newstitle" id="newstitle" autocomplete="off" required>
                <select name="newsfor" id="newsfor">
                    <option value="Everyone">Everyone</option>
                    <option value="Officers">Officers Only</option>
                    <option value="Non-officers">Non-officers Only</option>
                </select>
                <textarea name="newsdetails" id="newsdetails">
                </textarea>
                <input type="submit" name="submitnews" value="Add News">
            </form>
            <div class="close-addnew">
                <p>X</p>
            </div>
        </div>
    </div>

    <script src="./js/index.js"></script>
</body>
</html>