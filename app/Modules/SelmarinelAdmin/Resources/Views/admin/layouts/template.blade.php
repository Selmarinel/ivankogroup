@extends('SelmarinelCore::site.layouts.template')

@section('title', 'Admin Panel')

@section('links')
    <link rel="stylesheet" href="{{$app['selmarinel_admin.assets']->getPath('css/admin.css')}}">
    <link rel="stylesheet" href="{{$app['selmarinel_admin.assets']->getPath('css/custom.min.css')}}">
    <link href="{{$app['selmarinel_admin.assets']->getPath('css/icheck/flat/green.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div class="wrapper">
        <div class="content-wrapper">
            @include('selmarinel_admin::admin.layouts.navbar')
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Ivanko Group
                    <small>Админ Панель</small>
                </h1>
            </section>
            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="x_title">
                        <h2>
                            @yield('page_title')
                        </h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_content">
                                <table id="collection" class="table table-striped responsive-utilities jambo_table">
                                    <thead>
                                    <tr class="headings">
                                        <th>
                                            <input type="checkbox" class="tableflat">
                                        </th>
                                        @yield('tHead')
                                        <th class=" no-link last">
                                            <span class="nobr">Действия</span>
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @yield('tBody')
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </section>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{$app['SelmarinelCore.assets']->getPath('/js/lib/bootstrap/bootstrap.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('/js/lib/icheck/icheck.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('/js/lib/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('/js/lib/datatables/js/jquery.dataTables.js')}}"></script>
    <script src="{{$app['selmarinel_admin.assets']->getPath('/js/lib/datatables/tools/js/dataTables.tableTools.js')}}"></script>
    <script>
        $(document).ready(function () {
            $('input.tableflat').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass: 'iradio_flat-green'
            });
        });

        var asInitVals = new Array();
        $(document).ready(function () {
            var oTable = $('#collection').dataTable({
                "oLanguage": {
                    "sSearch": "Поиск по всех колонках:"
                },
                "aoColumnDefs": [
                    {
                        'bSortable': false,
                        'aTargets': [0]
                    } //disables sorting for column one
                ],
                'iDisplayLength': 12,
                "sPaginationType": "full_numbers",
                "dom": 'T<"clear">lfrtip',
                "tableTools": {
                    "sSwfPath": "{{$app['selmarinel_admin.assets']->getPath('js/lib/datatables/tools/swf/copy_csv_xls_pdf.swf')}}"
                }
            });
            $("tfoot input").keyup(function () {
                /* Filter on the column based on the index of this element's parent <th> */
                oTable.fnFilter(this.value, $("tfoot th").index($(this).parent()));
            });
            $("tfoot input").each(function (i) {
                asInitVals[i] = this.value;
            });
            $("tfoot input").focus(function () {
                if (this.className == "search_init") {
                    this.className = "";
                    this.value = "";
                }
            });
            $("tfoot input").blur(function (i) {
                if (this.value == "") {
                    this.className = "search_init";
                    this.value = asInitVals[$("tfoot input").index(this)];
                }
            });
        });
    </script>
@endsection