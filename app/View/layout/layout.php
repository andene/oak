<!DOCTYPE html>
<html class="no-js">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $this->title; ?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="/assets/css/foundation.min.css" type="text/css" media="screen" charset="utf-8">
        <link rel="stylesheet" href="/assets/css/style.css">

    </head>
    <body>
        <div class="menu">
            <div class="row">
                <div class="small-12">
                    <h1>Oak Framework</h1>
                    <nav class="top-bar" data-topbar data-options="sticky_on: large">
                        @include('partial.menu')
                    </nav>
                </div>
            </div>
        </div>

        <div class="row content">
            <div class="small-12">
                {{layout_content}}
            </div>
        </div>

    <div class="row">
        <footer class="small-12 ">
            @include('partial.footer')
        </footer>
    </div>

    <script src="js/main.js"></script>
    </body>
</html>
