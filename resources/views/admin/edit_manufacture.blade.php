<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard - SB Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('backend/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="{{ asset('backend/css/sb-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/font-awesome/css/font-awesome.min.css') }}">
    <!-- Page Specific CSS -->
    <link rel="stylesheet" href="http://cdn.oesmith.co.uk/morris-0.4.3.min.css">
  </head>
  <body>






    {{-- <section id="container" class="">
        @include('admin.dashboard')
    </section> --}}
<div id="page-wrapper">


    <div class="row">
      <div class="col-lg-12">
        <h1>Update Manufacture </h1>
        <ol class="breadcrumb">
          <li><a href="{{ URL::to('/dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li class="active"><i class="fa fa-edit"></i> Update Manufacture</li>
        </ol>

      </div>
    </div><!-- /.row -->
    <p class="alert-success">
        <?php
        $message = Session::get('message');
        if ($message)
        {
            echo $message;
            Session::put('message', null);
        }
        ?>
    </p>

    {{-- @yield('admin_content') --}}

    <div class="row">
      <div class="col-lg-6">
          <div class="box-content">

            <form class="form-horizontal" action="{{ url('/update-manufacture', $manufacture_info->manufacture_id) }}" method="POST">
                @csrf
                
                <fieldset>

                    <div class="control-group">
                        <label class="control-label" for="date01">Manufacture Name</label>
                        <div class="controls">
                            <input type="text" class="input-xlarge" name="manufacture_name" value="{{ $manufacture_info->manufacture_name }}">
                        </div>
                    </div>

                    <div class="control-group hidden-phone">
                        <label class="control-label" for="textarea2">Manufacture Description</label>
                        <div class="controls">
                            <textarea class="cleditor" name="manufacture_description" rows="3" cols="25">{{ $manufacture_info->manufacture_description }}</textarea>
                        </div>
                    </div>

                    {{-- <div class="control-group">
                        <label class="control-label" for="date01">Publication Status</label>
                        <div class="controls">
                            <input type="checkbox" name="publication_status" value="1">
                        </div>
                    </div> --}}

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary">Update Category</button>
                        <button type="reset" class="btn btn-danger">Cancel</button>
                    </div>
                </fieldset>
            </form>


        </div>
      </div>
    </div><!-- /.row -->

  </div><!-- /#page-wrapper -->


  <script src="{{ asset('backend/js/jquery-1.10.2.js') }}"></script>
    <script src="{{ asset('backend/js/bootstrap.js') }}"></script>

    <!-- Page Specific Plugins -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="http://cdn.oesmith.co.uk/morris-0.4.3.min.js"></script>
    <script src="{{ asset('backend/js/morris/chart-data-morris.js') }}"></script>
    <script src="{{ asset('backend/js/tablesorter/jquery.tablesorter.js') }}"></script>
    <script src="{{ asset('backend/js/tablesorter/tables.js') }}"></script>


</body>
</html>
