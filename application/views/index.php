<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="/css/style.css">
        <title>Нова пошта - тестове завдання!</title>
        <link rel="icon" href="/img/np.png">
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

        <div class="container">

            <form action="/" method="post" id="dateInterval">
                <div class="col">
                    <textarea name="dateInterval" id="dateInterval" cols="30" rows="4" placeholder="YYYY/MM/DD - MM.DD.YYY" autofocus></textarea>
                </div><!-- /.col -->
                <div class="col">
                    <button type="submit" id="post">POST</button>
                    <br>
                    <button id="ajax">AJAX</button>
                </div><!-- /.col -->
            </form>

            <div id="result" class="<?php echo isset($data['errors']) ? 'error' : 'success'; ?>">
                <?php if(isset($data['errors'])): ?>
                    <?php foreach ($data['errors'] as $error): ?>
                        <p><?php echo $error; ?></p>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p><?php echo isset($data['result']) ? $data['result'] : '%Результат%'; ?></p>
                <?php endif; ?>
            </div><!-- /#error -->

        </div><!-- /.container -->

        <script src="/js/jquery-3.1.0.min.js"></script>
        <script src="/js/script.js"></script>

    </body>
</html>