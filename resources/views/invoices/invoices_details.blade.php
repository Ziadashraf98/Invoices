@extends('layouts.master')
@section('css')
    <!---Internal  Prism css-->
    <link href="{{ URL::asset('assets/plugins/prism/prism.css') }}" rel="stylesheet">
    <!---Internal Input tags css-->
    <link href="{{ URL::asset('assets/plugins/inputtags/inputtags.css') }}" rel="stylesheet">
    <!--- Custom-scroll -->
    <link href="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css') }}" rel="stylesheet">
@endsection
@section('title')
    تفاصيل فاتورة
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">قائمة الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تفاصيل الفاتورة</span>
            </div>
        </div>

    </div>
    <!-- breadcrumb -->
@endsection
@section('content')


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


	@if(session()->has('success'))

	<div class="alert alert-success">

	<button type="button" class="close" data-dismiss="alert">x</button>

	{{session()->get('success')}}

	</div>

	@endif



    <!-- row opened -->
    <div class="row row-sm">

        <div class="col-xl-12">
            <!-- div -->
            <div class="card mg-b-20" id="tabs-style2">
                <div class="card-body">
                    <div class="text-wrap">
                        <div class="example">
                            <div class="panel panel-primary tabs-style-2">
                                <div class=" tab-menu-heading">
                                    <div class="tabs-menu1">
                                        <!-- Tabs -->
                                        <ul class="nav panel-tabs main-nav-line">
                                            <li><a href="#tab4" class="nav-link active" data-toggle="tab">معلومات
                                                    الفاتورة</a></li>
                                            <li><a href="#tab5" class="nav-link" data-toggle="tab">حالات الدفع</a></li>
                                            <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body tabs-menu-body main-content-body-right border">
                                    <div class="tab-content">


                                        <div class="tab-pane active" id="tab4">
                                            <div class="table-responsive mt-15">

                                                <table class="table table-striped" style="text-align:center">
                                                    <tbody>
                                                        <tr>
                                                            <th style="color: red" scope="row">رقم الفاتورة</th>
                                                            <td>{{ $invoices->invoice_number }}</td>
                                                            <th style="color: red" scope="row">تاريخ الاصدار</th>
                                                            <td>{{ $invoices->invoice_date }}</td>
                                                            <th style="color: red" scope="row">تاريخ الاستحقاق</th>
                                                            <td>{{ $invoices->due_date }}</td>
                                                            <th style="color: red" scope="row">القسم</th>
                                                            <td>{{ $invoices->Section->section_name }}</td>
                                                        </tr>

                                                        <tr>
                                                            <th style="color: red" scope="row">المنتج</th>
                                                            <td>{{ $invoices->product }}</td>
                                                            <th style="color: red" scope="row">مبلغ التحصيل</th>
                                                            <td>{{ $invoices->collection_amount }}</td>
                                                            <th style="color: red" scope="row">مبلغ العمولة</th>
                                                            <td>{{ $invoices->commission_amount }}</td>
                                                            <th style="color: red" scope="row">الخصم</th>
                                                            <td>{{ $invoices->discount }}</td>
                                                        </tr>


                                                        <tr>
                                                            <th style="color: red" scope="row">نسبة الضريبة</th>
                                                            <td>{{ $invoices->vat_rate }}</td>
                                                            <th style="color: red" scope="row">قيمة الضريبة</th>
                                                            <td>{{ $invoices->vat_value }}</td>
                                                            <th style="color: red" scope="row">الاجمالي مع الضريبة</th>
                                                            <td>{{ $invoices->total }}</td>
                                                            <th style="color: red" scope="row">الحالة الحالية</th>

                                                            @if ($invoices->status_value == 1)
                                                                <td><span
                                                                        class="badge badge-pill badge-success">{{ $invoices->status }}</span>
                                                                </td>
                                                            @elseif($invoices->status_value ==2)
                                                                <td><span
                                                                        class="badge badge-pill badge-danger">{{ $invoices->status }}</span>
                                                                </td>
                                                            @else
                                                                <td><span
                                                                        class="badge badge-pill badge-warning">{{ $invoices->status }}</span>
                                                                </td>
                                                            @endif
                                                        </tr>

                                                        <tr>
                                                            <th scope="row">ملاحظات</th>
                                                            <td>{{ $invoices->note }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="tab-pane" id="tab5">
                                            <div class="table-responsive mt-15">
                                                <table class="table center-aligned-table mb-0 table-hover"
                                                    style="text-align:center">
                                                    <thead>
                                                        <tr class="text-dark">
                                                            <th>#</th>
                                                            <th>رقم الفاتورة</th>
                                                            <th>نوع المنتج</th>
                                                            <th>القسم</th>
                                                            <th>حالة الدفع</th>
                                                            <th>تاريخ الدفع </th>
                                                            <th>ملاحظات</th>
                                                            <th>تاريخ الاضافة </th>
                                                            <th>المستخدم</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php $i = 0; ?>
                                                            <?php $i++; ?>
                                                            <tr>
                                                                <td>{{ $i }}</td>
                                                                <td>{{ $invoices->invoice_number }}</td>
                                                                <td>{{ $invoices->product }}</td>
                                                                <td>{{ $invoices->Section->section_name }}</td>
                                                                @if ($invoices->invoicesDetails->status_value == 1)
                                                                    <td><span
                                                                            class="badge badge-pill badge-success">{{ $invoices->status }}</span>
                                                                    </td>
                                                                @elseif($invoices->status_value ==2)
                                                                    <td><span
                                                                            class="badge badge-pill badge-danger">{{ $invoices->status }}</span>
                                                                    </td>
                                                                @else
                                                                    <td><span
                                                                            class="badge badge-pill badge-warning">{{ $invoices->status }}</span>
                                                                    </td>
                                                                @endif
                                                                <td>{{ $invoices->payment_date }}</td>
                                                                <td>{{ $invoices->invoicesDetails->note }}</td>
                                                                <td>{{ $invoices->invoicesDetails->created_at }}</td>
                                                                <td>{{ $invoices->invoicesDetails->user }}</td>
                                                            </tr>
                                                    </tbody>
                                                </table>


                                            </div>
                                        </div>


                                        <div class="tab-pane" id="tab6">
                                            <!--المرفقات-->
                                            <div class="card card-statistics">
                                                {{-- @can('اضافة مرفق') --}}
                                                    <div class="card-body">
                                                        <p class="text-danger">* صيغة المرفق pdf, jpeg ,.jpg , png </p>
                                                        <h5 class="card-title">اضافة مرفقات</h5>
                                                        <form method="POST" action="{{ url('/update_file' , $invoices->invoicesAttachment->id )}}/{{ $invoices->invoice_number }}/{{ $invoices->invoicesAttachment->file_name }}" enctype="multipart/form-data">
                                                            @csrf
                                                            <input class="btn btn-danger" type="file" name="pic">
                                                            <input class="btn btn-primary" type="submit" value="Save">
                                                        </form>
                                                    </div>
                                                {{-- @endcan --}}
                                                <br>

                                                <div class="table-responsive mt-15">
                                                    <table class="table center-aligned-table mb-0 table table-hover"
                                                        style="text-align:center">
                                                        <thead>
                                                            <tr class="text-dark">
                                                                <th scope="col">م</th>
                                                                <th scope="col">اسم الملف</th>
                                                                <th scope="col">قام بالاضافة</th>
                                                                <th scope="col">تاريخ الاضافة</th>
                                                                <th scope="col">العمليات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php $i = 0; ?>
                                                                <?php $i++; ?>
                                                                <tr>
                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $invoices->invoicesAttachment->file_name }}</td>
                                                                    <td>{{ $invoices->invoicesAttachment->created_by }}</td>
                                                                    <td>{{ $invoices->invoicesAttachment->created_at }}</td>
                                                                    <td colspan="2">

                                                                        <a class="btn btn-outline-success btn-sm"
                                                                            href="{{ url('/show_file') }}/{{ $invoices->invoice_number }}/{{ $invoices->invoicesAttachment->file_name }}"
                                                                            role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                            عرض</a>

                                                                        <a class="btn btn-outline-info btn-sm"
                                                                            href="{{ url('/download_file') }}/{{ $invoices->invoice_number }}/{{ $invoices->invoicesAttachment->file_name }}"
                                                                            role="button"><i
                                                                                class="fas fa-download"></i>&nbsp;
                                                                            تحميل</a>
																			
																			{{-- <a class="btn btn-outline-info btn-sm"
																				href="{{ url('/delete_file' , $invoices->id) }}/{{ $invoices->invoice_number }}/{{ $invoices->invoicesAttachment->file_name }}"
																				role="button"><i
																					class="fas fa-download"></i>&nbsp;
																				حذف</a> --}}
                                                                        

                                                                    </td>
                                                                </tr>
                                                        </tbody>
                                                        </tbody>
                                                    </table>

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
            <!-- /div -->
        </div>

	</div>
    <!-- /row -->

    <!-- delete -->
    <!-- Container closed -->
    <!-- main-content closed -->
@endsection
@section('js')
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!-- Internal Jquery.mCustomScrollbar js-->
    <script src="{{ URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js') }}"></script>
    <!-- Internal Input tags js-->
    <script src="{{ URL::asset('assets/plugins/inputtags/inputtags.js') }}"></script>
    <!--- Tabs JS-->
    <script src="{{ URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>
    <script src="{{ URL::asset('assets/js/tabs.js') }}"></script>
    <!--Internal  Clipboard js-->
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/clipboard/clipboard.js') }}"></script>
    <!-- Internal Prism js-->
    <script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>


    {{-- <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    </script> --}}

@endsection