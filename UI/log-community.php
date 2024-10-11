<?php
session_start();
include('../Mysql/connection.php');

$username = $_SESSION['username'];


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_concern'])) {

    $concern = $_POST['concern'];
    $stmt = $conn->prepare("INSERT INTO concern (username, concern) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $concern);
    $stmt->execute();
    $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_reply'])) {
    $concern_id = $_POST['concern_id'];

    $reply = $_POST['reply'];
    $stmt = $conn->prepare("INSERT INTO replies (concern_id, username, reply) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $concern_id, $username, $reply);
    $stmt->execute();
    $stmt->close();
}

$concerns = $conn->query("SELECT * FROM concern ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Community Concerns</title>
    <style>
        .container{
            margin-top: 10%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 30px;
        }
        .card{
            box-shadow: 0 0 5px 5px gray;
            padding: 20px;
            width: 80%;
            height: 15rem;
        }
        .com-card{
            box-shadow: 0 0 5px 5px gray;
            width: 40%;
            height: 15em;
        }
        form{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        .card{
            margin-top: 40px;
            box-shadow: 0 0 5px 5px gray;
            padding: 20px;
            height: auto;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .card-header{
            font-size: 30px ;
            font-weight: 600;
        }
        .text-center{
            text-align: center;
            
        }
        .btn{
            background: green;
            color: white;
            padding: 10px;
            border-radius: 20px;
            width: 10rem;
        }
        .text-area{
            width: 20em;
            height: 5em;
            font-size: 20px;
        }
        textarea{
            resize: none;  
        }
        .form-control{
            width: 20em;
            height: 3em;
            font-size: 20px;
        }
        .card-title{
            font-size: 35px;
            margin-bottom: 20px;
            font-weight: bolder;
        }
        .reply-header{
            font-size: 20px;
        }
        .reply-align{
            display: flex;
            gap: 10px;
            align-items: center;
            cursor: pointer;
            margin-bottom: 20px;
        }
        .reply{
            margin-bottom: 10px;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="com-card">
        <h2 class="text-center">Community Concerns</h2>
        
        <form method="POST">
            <div class="form-group">
                <textarea name="concern" class="text-area" rows="3" placeholder="Your Concern" required></textarea>
            </div>
            <button type="submit" name="submit_concern" class="btn">Submit Concern</button>
        </form>
    </div>

    <?php while ($row = $concerns->fetch_assoc()): ?>
        <div class="card">
            <div class="card-header">
                <div>
                    <?php echo htmlspecialchars($row['username']); ?>
                </div>
                <div>
                
                </div>
            </div>
            <div class="card-body">
                <div>
                    <h1 class="card-title"><?php echo htmlspecialchars($row['concern']); ?></h1>
                </div>
                <div class="reply-align" onclick="toggleReply(<?php echo $row['id']; ?>)">
                    <div>
                        <p class="reply-header">Replies:</p>
                    </div>
                    <div>
                        <p class="reply-header">▼</p>
                    </div>
                </div>
                
                <div class="" id="reply-field-<?php echo $row['id']; ?>" style="display: none;">

                
                <?php
                    $replies = $conn->query("SELECT * FROM replies WHERE concern_id = " . $row['id']);
                while ($reply = $replies->fetch_assoc()):
                ?>
                    <div class="reply">
                        <strong><?php echo htmlspecialchars($reply['username']); ?>:</strong> <?php echo htmlspecialchars($reply['reply']); ?>
                        <br>
                        <small class="text-muted">Replied on <?php echo $reply['created_at']; ?></small>
                    </div>
                <?php endwhile; ?>

                <form method="POST">
                    <input type="hidden" name="concern_id" value="<?php echo $row['id']; ?>">
                    <div class="form-group">
                        <textarea name="reply" class="form-control" rows="2" placeholder="Your Reply" required></textarea>
                    </div>
                    <button type="submit" name="submit_reply" class="btn btn-secondary">Reply</button>
                </form>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>
</body>
</html>

<?php $conn->close(); ?>
<script>
    function toggleReply(id) {
    var replyField = document.getElementById('reply-field-' + id); 
    if (replyField.style.display === 'none' || replyField.style.display === '') {
        replyField.style.display = 'block';
    } else {
        replyField.style.display = 'none';
    }
}
</script>
