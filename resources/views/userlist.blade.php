<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"/>
        <meta name="csrf_token" content="{{ csrf_token() }}" />
    </head>
    <body>
        <div class="container">
            <div class="jumbotron mt-3">
                <button id="exportusers" type="button" class="btn btn-primary btn-sm">Export</button> &nbsp;
                <button id="addusers" type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addusermodal">Add</button>
                <div id="tablecontainer">
                    @include('usertable')
                </div>
            </div>
        </div>

        <!-- Modal -->
        @include('usermodal')
        <!-- Modal -->
    </body>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="assets/js/users.js"></script>
    <script>
        var user_table_reload_route = "{{route('user-table-reload')}}";
        var add_user_route = "{{route('add-user')}}";
        var edit_user_route = "{{route('edit-user')}}";
        var update_user_route = "{{route('update-user')}}";
        var export_user_route = "{{route('export-user')}}";
    </script>
</html>
