@extends('layouts.admin.main')

@section('title', 'Track')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet"
          href="{{ asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
     folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/select2/dist/css/select2.min.css') }}">
    <!-- bootstrap datepicker -->
    <link rel="stylesheet"
          href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Edit Album</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('admin/albums') }}"><i class="fa fa-dashboard"></i> Albums</a></li>
                <li><a href="{{ action('\Vadiasov\TracksAdmin\Controllers\TracksController@index', $album->id) }}"><i class="fa fa-music"></i> Tracks</a></li>
                <li><a href="#">Edit Track</a></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-info">
                        <div class="box-header with-border" style="margin-bottom: 10px">
                            <h3 class="box-title">Edit Track of Album <span>{{ $album->title }}</span></h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form class="form-horizontal" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                            <input type="hidden" name="album_id" value="{!! $album->id !!}">
                            <input type="hidden" name="track_id" value="{!! $track->id !!}">

                            @foreach ($errors->all() as $error)
                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-6 alert alert-danger">{{ $error }}</div>
                                </div>
                            @endforeach

                            <div class="box-body">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Track Title</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="title"
                                               placeholder="Name (only letters, digits, defis, apostrophe, space)"
                                               value="{{ old('title') ? old('title') : $track->title }}">
                                    </div>
                                </div>

                                <!-- Date -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Release Date:</label>

                                    <div class="col-sm-9">
                                        <div class="input-group date">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input type="text" class="form-control pull-right" id="datepicker"
                                                   name="release_date" placeholder="dd-mm-yyyy"
                                                   value="{{ old('release_date') ? old('release_date') : $track->release_date }}">
                                        </div>
                                    </div>
                                    <!-- /.input group -->
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Price</label>

                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="price"
                                               placeholder="000.00"
                                               value="{{ old('price') ? old('price') : $track->price }}">
                                    </div>
                                </div>

                                <!-- radio -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Free or paid?</label>

                                    <div class="radio col-sm-9">
                                        <div>
                                            <label>
                                                <input type="radio" name="free" id="optionsRadios1" value="0"
                                                       @if(old('free') and old('free') == '0' ) checked="checked"
                                                       @else ($track->free === '0') checked="checked" @endif >
                                                Free
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="free" id="optionsRadios2" value="1"
                                                       @if(old('free') and old('free') == '1' ) checked="checked"
                                                       @else ($track->free === '1') checked="checked" @endif >
                                                Paid
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- radio -->
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Is Donate possible?</label>

                                    <div class="radio col-sm-9">
                                        <div>
                                            <label>
                                                <input type="radio" name="donate" id="optionsRadios3" value="0"
                                                       @if(old('donate') and old('donate') == '0' ) checked="checked"
                                                       @else ($track->donate === '0') checked="checked" @endif >
                                                Yes
                                            </label>
                                        </div>
                                        <div>
                                            <label>
                                                <input type="radio" name="donate" id="optionsRadios4" value="1"
                                                       @if(old('donate') and old('donate') == '1' ) checked="checked"
                                                       @else ($track->donate === '1') checked="checked" @endif >
                                                No
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Genres</label>

                                    <?php
                                    if (old('genres')) {
                                        $arrayJs = '[' . implode(",", old('genres')) . ']';
                                    }
                                    ?>

                                    <div class="col-sm-9">
                                        <select class="form-control select2" multiple="multiple"
                                                data-placeholder="Select Genres" name="genres[]"
                                                style="width: 100%;">
                                            @foreach($genres as $key=>$genre)
                                                <option value="{{ $key }}">{{ $genre->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-3 control-label">About Album</label>
                                    <div class="col-sm-9">
                                        <div class="box-body pad">
                                            <textarea id="editor1" name="editor1" rows="10" cols="80"
                                                      placeholder="About">{{ old('editor1') ? old('editor1') : $track->about }}</textarea>
                                        </div>
                                    </div>
                                    <!-- /.box -->
                                </div>

                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <a href="{{ route('admin/albums') }}" class="btn btn-default">Cancel</a>
                                    <button type="submit" class="btn btn-info pull-right">Save</button>
                                </div>
                                <!-- /.box-footer -->
                            </div>
                        </form>
                    </div>
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
    <!-- InputMask -->
    <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('admin/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('admin/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('admin/dist/js/demo.js') }}"></script>
    <!-- CK Editor -->
    <script src="{{ asset('admin/bower_components/ckeditor/ckeditor.js') }}"></script>
    <!-- bootstrap datepicker -->
    <script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
    <!-- page script -->
    <script>
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2();

            //Datemask dd/mm/yyyy
//            $('#datepicker').inputmask('dd-mm-yyyy', {'placeholder': 'dd-mm-yyyy'});
            //Datemask2 mm/dd/yyyy
//            $('#datemask2').inputmask('mm/dd/yyyy', {'placeholder': 'mm/dd/yyyy'});

            //Date picker
            $('#datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true
            });

            $('#example1').DataTable();
            $('#example2').DataTable({
                'paging': true,
                'lengthChange': false,
                'searching': false,
                'ordering': true,
                'info': true,
                'autoWidth': false
            });

            // Replace the <textarea id="editor1"> with a CKEditor
            // instance, using default configuration.
            CKEDITOR.replace('editor1')

        });

        //        $('.select2').val(["1","2"]);
        $('.select2').val({{ $arrayJs }});
    </script>
@endsection