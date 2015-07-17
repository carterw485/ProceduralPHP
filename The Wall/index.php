<?php
session_start();
require_once('connection.php');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>The Wall</title>
    <meta name="description" content="The wall"/>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">The Wall</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php if(empty($_SESSION['id'])){ ?>
                <form class="navbar-form navbar-right" action="process.php" method="post">
                    <?php if(isset($_SESSION['badlogin'])){ ?>
                    <div class="form-group has-error bars">
                    <?php } 
                          else{ ?>
                    <div class="form-group">
                    <?php } ?>
                    <input type="text" placeholder="Email" class="form-control" name="email">
                    <?php if(isset($_SESSION['badlogin'])){ ?>
                    <span class="help-block">Invalid log in credentials</span>
                    <?php } ?>
                    </div>
                    <?php if(isset($_SESSION['badlogin'])){ ?>
                    <div class="form-group has-error bars">
                    <?php } 
                          else{ ?>
                    <div class="form-group">
                    <?php } ?>
                    <input type="password" placeholder="Password" class="form-control" name="password">
                    <?php if(isset($_SESSION['badlogin'])){ ?>
                    <span class="help-block">Please try to sign in again</span>
                    <?php unset($_SESSION['badlogin']); ?>
                    <?php } ?>
                    </div>
                    <input type="submit" class="btn btn-success" value="Sign in" name="signin">
                    <input type="submit" class="btn btn-primary" value="Register" name="register">
                </form>
            <?php }
                  else{ 
                  $user = "SELECT * FROM users WHERE id = '{$_SESSION['id']}'";
                  $user = fetch($user);
                  ?>
                
                <form class="navbar-form navbar-right" action="process.php" method="post">
                    <div class="form-group">
                        <h2>Welcome <?= $user[0]['first_name']; ?>!</h2>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Sign out" name="signout">
                    </div>
                </form>
                
            <?php } ?>
        </div><!--/.navbar-collapse -->
    </div>
</nav>


<div class="container wrapper">
<?php if(isset($user)){ ?>
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6 message">
            <form action="process.php" method="post">
                <h3>Post a message</h3>
                <div class="form-group">
                    <textarea class="form-control" name="user_message"></textarea>
                </div>
                <p><input type="submit" class="btn btn-primary" name="message"></p>
            </form>
        </div>
        <div class="col-md-3">
        </div>
  </div>
<?php } ?>
<?php 
$messages = "SELECT users.id, first_name, last_name, message, messages.created_at, messages.id as m FROM messages
LEFT JOIN users 
ON messages.id 
WHERE messages.users_id = users.id
ORDER BY messages.id";
$messages = fetch($messages);
foreach(array_reverse($messages) as $message){ ?>
<?php $date = date_create($message['created_at']); ?>
<div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="blog-post">
                <h2 class="blog-post-title"><?= $message['first_name'] . ' ' . $message['last_name']; ?></h2>
                <p class="blog-post-meta"><?= date_format($date, 'g:ia M d, Y'); ?></p>
                <p class="message"><?= $message['message']; ?></p>

<?php
$comments = "SELECT comment, users_id, messages_id as msgid, comments.created_at, users.first_name as name
FROM comments 
LEFT JOIN users
ON comments.users_id = users.id
WHERE comments.messages_id = '{$message['m']}'";
$comments = fetch($comments);
?>
                <?php if(!empty($comments)){ ?>
                <div class="comment-box">
                    <h4 class="text-primary">Comments</h4>
                    <?php foreach($comments as $comment){
                        
                        $date = date_create($comment['created_at']);
                    ?>
                    <div class="comments">
                        
                        <h4 class="text-success"><?= $comment['name']; ?></h4>
                        
                        <p class="blog-post-meta"><?= date_format($date, 'g:ia M d, Y'); ?></p>
                       
                        <p><?= $comment['comment'] ?></p>
                        
                    </div>
                    <?php } ?>
                </div>
                <?php } ?>
              
                <form action="process.php" method="post" class="comment">
                    <h4 class="text-primary">Add a comment</h4>
                    <div class="form-group">
                        <textarea class="form-control" name="user_comment"></textarea>
                    </div>
                    <input type="hidden" value="<?= $message['m']; ?>" name="messageid">
                    <p><input type="submit" class="btn btn-success" name="comment" value="Comment"></p>
                </form>
            </div>
        </div>
        <div class="col-md-3">
    </div>
</div>
<?php } ?>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script type="text/javascript" src="hover.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
</body>
</html>
        

    