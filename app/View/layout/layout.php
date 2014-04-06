<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php echo $this->title; ?></title>
        <meta name="description" content="<?php echo $this->description; ?>">
        <style>
            .container {
                width: 960px;
                margin:0 auto;
                font-family: Helvetica, Arial;
                font-weight: 200;
                color: #22313F
            }
            a {
                color: #2574A9;
            }
            h1 {
                font-weight: 200;
            }
        </style>
    </head>
    <body>
        <div class="container">
            {{layout_content}}
        </div>
    </body>
</html>
