<?php

// セッション開始
session_start();

error_reporting(E_ALL & ~E_NOTICE);
ini_set("display_errors", 1);

// SessionEvent送信関数の読み込み
require_once('../lib/caliper-session.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_name = $_POST['user_name'];
    $login_time = new DateTime();

    if(sendSessionLoggedIn($user_name, $login_time)) {
        // イベント送信成功時に表示するメッセージ
        $_SESSION['message'] = 'SessionEvent(Logged In) was sent successfully.';
    } else {
        // イベント送信失敗時に表示するメッセージ
        $_SESSION['message'] = 'Failed to send SessionEvent(Logged In).';
    }

    $_SESSION['user_name'] = $user_name;
    $_SESSION['login_time'] = $login_time;

    header('Location: ./logout.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Caliper Sample App for PHP Sensor</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js" integrity="sha256-/BfiIkHlHoVihZdc6TFuj7MmJ0TWcWsMXkeDFwhi0zw=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/languages/json.min.js" integrity="sha256-KPdGtw3AdDen/v6+9ue/V3m+9C2lpNiuirroLsHrJZM=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css" integrity="sha256-3YM6A3pH4QFCl9WbSU8oXF5N6W/2ylvW0o2g+Z6TmLQ=" crossorigin="anonymous" />
    
    <style>
        body {
            font-size: 14px;
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-toggleable-md navbar-light bg-faded mb-4">
        <div class="container">
            <a class="navbar-brand" href="login.php">Caliper Sample App for PHP Sensor</a>
        </div>
    </nav>

    <?php if($_SESSION['message']): ?> 

    <div class="container mb-4 alert alert-info">
        <?php echo $_SESSION['message']; ?>
        <?php unset($_SESSION['message']); ?>
    </div>

    <?php endif; ?>

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-6">
                <div class="card  card-block">

                    <form action="login.php" method="POST">
                        <div class="form-group">
                            <label>User name</label>
                            <input type="text" class="form-control" name="user_name" />
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="user_password" />
                        </div>
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary btn-block">Login</button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</body>
</html>
