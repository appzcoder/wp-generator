<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WP Generator</title>
    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootswatch/3.3.6/flatly/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding-top: 100px;
        }
        .entry:not(:first-of-type) {
            margin-top: 10px;
        }
        .glyphicon {
            font-size: 12px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">WP Generator</a>
            </div>
        </div><!-- /.container-fluid -->
    </nav>

    <div class="container">
        <h2 class="text-center">WP List Table Plugin Generator</h2>
        <br />
        <form class="form-horizontal" method="post" action="process.php">
            <div id="plugin-area">
                <div class="form-group">
                    <label for="plugin_name" class="col-md-4 control-label">Plugin Name:</label>
                    <div class="col-md-4">
                        <input type="text" name="plugin_name" class="form-control" id="plugin_name" placeholder="Plugin Name" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="plugin_url" class="col-md-4 control-label">Plugin URL:</label>
                    <div class="col-md-4">
                        <input type="text" name="plugin_url" class="form-control" id="plugin_url" placeholder="http://www.appzcoder.com" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="plugin_description" class="col-md-4 control-label">Plugin Description:</label>
                    <div class="col-md-4">
                        <input type="text" name="plugin_description" class="form-control" id="plugin_description" placeholder="A sample plugin." />
                    </div>
                </div>
                <div class="form-group">
                    <label for="plugin_version" class="col-md-4 control-label">Plugin Version:</label>
                    <div class="col-md-4">
                        <input type="text" name="plugin_version" class="form-control" id="plugin_version" placeholder="0.1" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="plugin_author" class="col-md-4 control-label">Plugin Author:</label>
                    <div class="col-md-4">
                        <input type="text" name="plugin_author" class="form-control" id="plugin_author" placeholder="Sohel Amin" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="plugin_author_url" class="col-md-4 control-label">Plugin Author URL:</label>
                    <div class="col-md-4">
                        <input type="text" name="plugin_author_url" class="form-control" id="plugin_author_url" placeholder="http://www.sohelamin.com" />
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="crud_name" class="col-md-4 control-label">Crud Name:</label>
                <div class="col-md-4">
                    <input type="text" name="crud_name" class="form-control" id="crud_name" placeholder="customers" required="true" />
                </div>
            </div>
            <div class="form-group">
                <label for="textdomain" class="col-md-4 control-label">Textdomain:</label>
                <div class="col-md-4">
                    <input type="text" name="textdomain" class="form-control" id="textdomain" placeholder="appzcoder" required="true" />
                </div>
            </div>
            <div class="form-group">
                <label for="prefix" class="col-md-4 control-label">Prefix:</label>
                <div class="col-md-4">
                    <input type="text" name="prefix" class="form-control" id="prefix" placeholder="ac_" required="true" />
                </div>
            </div>
            <hr/>
            <div class="form-group table-fields">
                <h4 class="text-center">Table/Form Fields:</h4><br/>
                <div class="entry col-md-9 col-md-offset-3 form-inline">
                    <input class="form-control" name="fields[]" type="text" placeholder="field_name" required="true"/>
                    <select name="fields_type[]" class="form-control">
                        <option value="text">Text</option>
                        <option value="textarea">Textarea</option>
                        <option value="number">Number</option>
                        <option value="email">Email</option>
                        <option value="select">Select</option>
                        <option value="checkbox">Checkbox</option>
                        <option value="radio">Radio</option>
                    </select>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="fields_required[]"> Required
                        </label>
                    </div>
                    <button class="btn btn-success btn-add inline" type="button">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </div>
            </div>
            <br>
            <div class="form-group">
                <div class="col-sm-offset-4 col-md-4">
                    <button type="submit" class="btn btn-primary" name="generate">Generate Plugin</button>
                </div>
            </div>
        </form>
    </div>

    <hr/>

    <div class="container">
        &copy; <?php echo date('Y');?>. Created by <a href="http://www.appzcoder.com">AppzCoder</a>
        <br/>
    </div>

    <!-- Scripts -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    $( document ).ready(function() {

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();

            var tableFields = $('.table-fields'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo(tableFields);

            newEntry.find('input').val('');
            tableFields.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus"></span>');
        }).on('click', '.btn-remove', function(e) {
            $(this).parents('.entry:first').remove();
            e.preventDefault();

            return false;
        });

    });
    </script>
</body>
</html>