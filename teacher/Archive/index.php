<!-- Archive Home (index.html) for Teacher account -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> Gonzaga Small Talk</title>

    <!-- Bootstrap -->
    <link href="/css/bootstrap.css" rel="stylesheet">
    <link href="/css/datepicker.css" rel="stylesheet">
    <link href="/css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet/less" type="text/css" href="/datepicker.less" />

    <!-- Including Header -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script>
        $(function(){
            $("#header").load("/header.html");
        });
    </script>

    <!-- Background Setup -->
    <style>
        body{
            background: url(/media/gonzagasmalltalk_background.png) no-repeat center center fixed;
                -webkit-background-size: cover;
                -moz-background-size: cover;
                -o-background-size: cover;
                background-size: auto;
        }
    </style>
</head>
        
        

<body>
    <div id="header"></div>
    <div id="wrapper">
        <div id="sidebar-wrapper">
            <u1 class="sidebar-nav">
                <li class="sidebar-brand">
                    <a href="/Teacher/Home/index.html">Home</a>
                </li>
                <li class="sidebar-brand">
                    <a href="/Teacher/Archive/index.html">Archive Home</a>
                </li>
                <li class="sidebar-brand">
                    <a href="/Teacher/Archive/Courses/index.html">Search Courses</a>
                </li>
                <li class="sidebar-brand">
                    <a href="/Teacher/Archive/Worksheets/index.html">Search Worksheets</a>
                </li>
                <li class="sidebar-brand">
                    <a href="/Teacher/Archive/Expressions/index.html">Search Expressions</a>
                </li>

                <li class="sidebar-brand">
                    <a href="#">Help</a>
                </li>

            </u1>

        </div>
        
   
        <div id="page-content-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <a href="#menu-toggle" class="btn btn-default" id="menu-toggle">Collapse/Expand</a>
                        <!-- BEGIN PAGE CONTENT -->
                        <h2>Teacher Name: Archive</h2>
                        <p>Archive access home for teacher user.  Through this page, the teacher will be able to view all non-active courses (decision to be made: all courses, or only those that are taught by that particular teacher?).  Links will be provided in the Archive Sidebar for navigation to different sections of the Archive, including courses, worksheets, and expressions (search functionality included in each)  </p>
        
                        <!-- END PAGE CONTENT -->
                    </div>
                </div>


            </div>
        </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/bootstrap-datepicker.js"></script>
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
</body>
</html>