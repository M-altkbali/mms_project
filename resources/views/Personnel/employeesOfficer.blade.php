@extends('layout.main')
@section('content')
@section('title_content_main')
    الضباط
@section('title_content_sub')
    عرض الضباط
@endsection
@endsection
<div class="panel">
<div class="panel-body">
   
    <div class="table-responsive">
        <table class="table m-0 table-colored table-success" id="datatable-editable">
            <thead>
                <tr>
                    <th>رقم التسلسلي</th>
                    <th>الرقم العسكري</th>
                    <th>الاسم</th>
                    <th>الرتبه</th>
                    <th>قرار التعيين</th>
                    <th>الرقم الوطني</th>
                    {{-- <th>الدرجة الحاليه</th>
                    <th>تاريخ الحصول عليها</th> --}}
                    <th>المؤهل العلمي</th>
                    <th>رقم الهاتف</th>
                    <th>رقم القيد</th>
                    <th>ملاحظات</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($employeesOfficer as $employee)
                    <tr>
                        <th scope="row">{{ $employee->id }}</th>
                        <td>{{ $employee->military_number }}</td>
                        <td>{{ $employee->full_name }}</td>
                        <td>{{ $employee->Rank }}</td>
                        <td>{{ $employee->appointment_decision }}</td>
                        <td>{{ $employee->national_no }}</td>

                        {{-- <td>{{ $employee->current_grade }}</td>
                        <td>{{ $employee->current_grade_date }}</td> --}}


                        <td>{{ $employee->qualification }}</td>
                        <td>{{ $employee->phone_n }}</td>
                        <td>{{ $employee->Contract_registrationNo }}</td>
                        <td>{{ $employee->notes }}</td>

                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</div>
</div>
@endsection
