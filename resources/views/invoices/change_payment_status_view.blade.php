@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('title')
    تغيير حالة الدفع
@stop

@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    تغيير حالة الدفع</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')

    <!-- row -->
    @if(session()->has('success'))

    <div class="alert alert-success">

    <button type="button" class="close" data-dismiss="alert">x</button>

    {{session()->get('success')}}

    </div>

    @endif

    <!-- row -->
    <div class="row">

        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{url('/update_payment_status' , $invoice->id)}}" method="POST" >
                        @csrf
                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input  value="{{$invoice->invoice_number}}" class="form-control" id="inputName" 
                                    title="يرجي ادخال رقم الفاتورة">
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input readonly class="form-control fc-datepicker"  placeholder="YYYY-MM-DD"
                                    type="text" value="{{$invoice->invoice_date}}">
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input value="{{$invoice->due_date}}" class="form-control fc-datepicker"  placeholder="YYYY-MM-DD"
                                    type="text">
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <input type="text" value="{{$invoice->section->section_name}}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المنتج</label>
                                <input readonly type="text" value="{{$invoice->product}}">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input value="{{$invoice->collection_amount}}" type="text" class="form-control" id="inputName">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input value="{{$invoice->commission_amount}}" type="text" class="form-control form-control-lg" id="Amount_Commission"
                                     title="يرجي ادخال مبلغ العمولة ">
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input value="{{$invoice->discount}}" type="text" class="form-control form-control-lg" id="Discount" >
                            </div>

                        </div>
                        <br>
                        
                        <div>
                            <label for="inputName" class="control-label">حالة الدفع</label>
                            <select name="payment_status">
                                <option>مدفوعة</option>
                                <option>غير مدفوعة</option>
                                <option>مدفوعة جزئيا</option>
                            </select>
                        </div>
                        
                        <br>
                        
                        <div>
                        <label for="inputName" class="control-label">تاريخ الدفع</label>
                        <input name="payment_date" type="date" value="{{date('Y-m-d')}}">
                        </div>


                        {{-- 5 --}}
                        <br>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">تحديث حالة الدفع</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>

    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>

    <script>
        var date = $('.fc-datepicker').datepicker({
            dateFormat: 'yy-mm-dd'
        }).val();

    </script>



@endsection