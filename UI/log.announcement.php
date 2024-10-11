<?php
include("../Mysql/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .announ-content{
        margin-top: 10%;
        display: flex;
        height: 20%;
        align-items: center;
        justify-content: center;
    }
    .category{
        position: fixed;
        left; 0;
        width 50%
        border: 2px solid black;
        box-shadow: 0 0 5px 5px gray;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        padding: 20px;
    }
    .post-content{
        width: 100vh;
        padding: 20px;
        box-shadow: 0 0 5px 5px gray;
        margin-bottom:50px ;
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
</style>
<body>
<div class="announ-container">
    <div class="category">
        <form method="POST" action="">
            <div>
                <label for="searchbar">Search</label>
                <input type="text" id="searchbar" name="searchTerm">
            </div>
            <div>
                <?php
                    // Fetch the available sitios
                    $select = "SELECT * FROM sitio";
                    $result = $conn->query($select);
                    if ($result->num_rows > 0) {
                        echo '<label for="combobox">Category</label>';
                        echo '<select id="combobox" name="sitio">';
                        echo '<option value="">All Sitios</option>'; // Default option
                        while ($row = $result->fetch_assoc()) {
                            echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                        }
                        echo '</select>';
                    }
                ?>
            </div>
            <button type="submit">Search</button>
        </form>
    </div>
    
    <div class="announ-content">
        <div class="post-container">
            <?php
                $searchTerm = isset($_POST['searchTerm']) ? trim($_POST['searchTerm']) : '';
                $sitio = isset($_POST['sitio']) ? trim($_POST['sitio']) : '';

                $select = "SELECT * FROM announcements WHERE 1=1"; 
                $params = []; 
                $paramTypes = ""; 

                if (!empty($searchTerm)) {
                    $select .= " AND topic LIKE ?"; 
                    $searchTerm = "%" . $searchTerm . "%";
                    $params[] = $searchTerm;
                    $paramTypes .= "s"; 
                }

                if (!empty($sitio)) {
                    $select .= " AND sitio = ?"; 
                    $params[] = $sitio; 
                    $paramTypes .= "s";
                }

                $select .= " ORDER BY ID DESC";

                $stmt = $conn->prepare($select);

                if (count($params) > 0) {
                    $stmt->bind_param($paramTypes, ...$params);
                }
                
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $currentDateTime = new DateTime(); 
                        $postDateTime = new DateTime($row['date']); 
                        $interval = $currentDateTime->diff($postDateTime);
                        $isNewPost = ($interval->days == 0 && $interval->h < 24);

                        echo "<div class='post-content'>";
                        if ($isNewPost) {
                            echo "<p style='color: red; float: right;'>New Post!</p>"; 
                        }
                        echo "<h1>" . htmlspecialchars($row['topic']) . "</h1>"; 
                        echo "<h1>" . htmlspecialchars($row['date']) . "</h1>";
                        echo "<h1>Sitio: " . htmlspecialchars($row['sitio']) . "</h1>";
                        
                        echo "<div>";
                            echo "<img src='../system/display_image.php?id=" . $row['id'] . "' alt='Post Image' style='max-width:100%; height:auto;' />";
                            echo "<p>" . htmlspecialchars($row['context']) . "</p>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "No posts found.";
                }

                $stmt->close();
            ?>
        </div>
    </div>
</div>


</body>
</html>