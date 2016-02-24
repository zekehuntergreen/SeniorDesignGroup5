<?php include '../../base.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Snippet - Bootsnipp.com</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
     <link href="/css/advancedsearch.css" rel="stylesheet">
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
    <script type="text/javascript">$(function()
    {
        $(document).on('click', '.btn-add', function(e)
        {
            e.preventDefault();

            var controlForm = $('.controls form:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(controlForm);

            newEntry.find('input').val('');
            controlForm.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus"></span>');
        }).on('click', '.btn-remove', function(e)
        {
            $(this).parents('.entry:first').remove();
            e.preventDefault();
            return false;
        });
    });
    </script>
    <style>
        .btn-add {
            min-height: 34px;
        }
        .btn-remove {
            min-height: 34px;
        }
        .btn-primary {
            float: right; 
            min-width: 200px;
            min-height: 34px;
        }
        .input-group {
            min-width: 569px;
        }
    </style>
</head>
    
<?php
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
    if( !(($_SESSION['Role'] == 'admin') || ($_SESSION['Role'] == 'teacher') ))
    {
        ?>
        <p>You do not have permission to view this page.  Redirecting in 5 seconds</p>
        <p>Click <a href="/">here</a> if you don't want to wait</p>
        <meta http-equiv='refresh' content='5;/' />
        <?php
    }
    else
    {
        ?>
        <body>
                        
        <div class="control-group" id="fields">
        <div class="controls"> 
        <div class="well"> 
        <form method="POST" action="../Results/" role="form" autocomplete="off">
            <div class="form-group">
                <label for="filter">Level</label>
                <select class="form-control">
                    <option value="profileID">1</option>
                    <option value="profileID">2</option>
                    <option value="profileID">3</option>
                    <option value="profileID">4</option>
                    <option value="profileID">5</option>
                    <option value="profileID">6</option>
                    <option value="profileID">7</option>
                    <option value="profileID">8</option>
                  </select>
             </div><br>
            <label for="contain">Language</label>
            <div class="form-group">
                <input class="form-control" type="text">
            </div><br>
            <label for="contain">Topic</label>
            <div class="form-group">
                <input class="form-control" type="text">
            </div>
        <div class="entry col-lg-10">
        <div class="container">
        <label for="contain">Word Search</label>
            <div class="word filter">
                <div class="row">
                    <div class="col-md-14">
                        <div class="input-group" id="adv-search">
                            <span class="input-group-btn">
                                <button class="btn btn-success btn-add" type="button">
                                    <span class="glyphicon glyphicon-plus"></span>
                                </button>
                            </span>
                            <input type="text" class="form-control" placeholder="Search for a word">
                            <div class="input-group-btn">
                                <div class="btn-group" role="group">
                                    <div class="dropdown dropdown-lg">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></button>
                                        <div class="dropdown-menu dropdown-menu-right" role="menu">

                                            <div class="form-group">
                                                <h3><label for="filter">Part of Speech</label></h3>
                                                <br>
                                                <select class="form-control">
                                                    <option value="profileID">Verbs</option>
                                                    <option value="profileID">Nouns</option>
                                                    <option value="profileID">Pronouns</option>
                                                    <option value="profileID">Adverbs</option>
                                                    <option value="profileID">Adjectives</option>
                                                    <option value="profileID">Prepositions</option>
                                                    <option value="profileID">Conjunctions</option>
                                                    <option value="profileID">Interjections</option>
                                                 </select>
                                              </div>                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
</div>
          
</div>
<div class="col-xs-5">
<button type="submit" class="btn btn-primary" ><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
    <!-- THIS WILL SEARCH THE WHOLE FIELD -->
</form>
</div>
</div>
</div>
</body>
    <?php
    }
}
    ?>

</html>