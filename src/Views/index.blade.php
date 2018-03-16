@extends('layouts.admin.main')

@section('title', 'Tracks')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet"
          href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Tracks</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin/albums') }}"><i class="fa fa-dashboard"></i> Albums</a></li>
                <li><a href="#">Tracks</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Data Table With Tracks of Album <span
                                        style="color: #3c8dbc">{{ $album->title }}</span></h3>
                            <a href="{{ action('\Vadiasov\Upload\Controllers\UploadController@upload', ['albumsAdmin', $album->id]) }}"
                               class="btn btn-info pull-right">Add Tracks</a>
                            <a href="{{ action('\Vadiasov\Ordering\Controllers\OrderingController@index', ['tracks', $album->id]) }}"
                               class="btn btn-success pull-right" style="margin-right: 20px">Order Tracks</a>
                            @if (session('status'))
                                <h4 class="alert alert-success" style="margin-top: 20px;">
                                    {{ session('status') }}
                                </h4>
                            @endif
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>File</th>
                                    <th>Test</th>
                                    <th>Release</th>
                                    <th>Price</th>
                                    <th>Free</th>
                                    <th>Donate</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Add Arts</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tracks as $track)
                                    <tr>
                                        <td>{{ $track->id }}</td>
                                        <td>{{ $track->order }}</td>
                                        <td>{{ $track->title }}</td>
                                        <td>{{ $track->file }}</td>
                                        <td>
                                            <audio controls>
                                                <source src="{{ asset('storage/tracks/' . $track->file) }}">
                                            </audio>
                                        </td>
                                        <td>{{ $track->release_date }}</td>
                                        <td>{{ $track->price }}</td>
                                        <td>{{ $track->free }}</td>
                                        <td>{{ $track->donate }}</td>
                                        <td>{{ $track->created_at }}</td>
                                        <td>{{ $track->updated_at }}</td>
                                        <td>
                                            <a href="{{action('\Vadiasov\Upload\Controllers\UploadController@upload4', ['artsAdminFromTracks', $album->id, $track->id])}}"
                                               title="Add Arts">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{action('\Vadiasov\TracksAdmin\Controllers\TracksController@edit', [$album->id, $track->id])}}">
                                                <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                            <a href="{{action('\Vadiasov\ArtsAdmin\Controllers\ArtsController@indexTrack', [$album->id, $track->id])}}">
                                                <i class="fa fa-file-image-o" aria-hidden="true"></i></a>
                                            <a href="{{action('\Vadiasov\TracksAdmin\Controllers\TracksController@destroy', [$album->id, $track->id])}}">
                                                <i class="fa fa-trash" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Order</th>
                                    <th>Title</th>
                                    <th>File</th>
                                    <th>Test</th>
                                    <th>Release</th>
                                    <th>Price</th>
                                    <th>Free</th>
                                    <th>Donate</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Add Arts</th>
                                    <th>Actions</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@section('js')
    <!-- DataTables -->
    <script src="{{ asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            $('#example1').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });
        })
    </script>
@endsection