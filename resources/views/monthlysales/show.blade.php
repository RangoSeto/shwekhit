@extends('layouts.adminindex')
@section('content')
    <div class="container-fluid">


        <div class="col-md-12">

            <table id="mytable" class="table table-responsive table-hover border">
                <thead class="">
                    <th>No</th>
                    <th>Created at</th>
                    <th>Item</th>
                    <th>ပို</th>
                    <th>ဖာ</th>
                    <th>Price</th>
                </thead>
                <tbody>

                @foreach($stockins as $idx=>$stockin)
                    <tr id="delete_{{$stockin->id}}">
                        <td>{{++$idx}}</td>
                        <td>{{date('d M Y',strtotime($stockin->created_at))}}</td>
                        <td>{{$stockin->item->name}}</td>
                        <td>{{$stockin->pocount}}</td>
                        <td>{{$stockin->pharcount}}</td>
                        <td>{{ number_format($stockin->price ,2,'.',',')  }}</td>

                    </tr>
                @endforeach

                    <tr>
                        <td colspan="2"></td>
                        <td class="text-center fw-bold">Total</td>
                        <td>{{$totals->total_pocount}}</td>
                        <td>{{$totals->total_pharcount}}</td>
                        <td>{{ number_format($totals->total_price,2,'.',',') }}</td>
                    </tr>

                    <tr class="border-danger">
                        <td colspan="2"></td>
                        <td class="text-center fw-bold">Commercial</td>
                        <td colspan="2"></td>

                        <td>{{ number_format($commercial,2,'.',',') }}</td>
                    </tr>

                <tr class="table-active">
                    <td colspan="2"></td>
                    <td class="text-center fw-bold">Total Amount</td>
                    <td colspan="2"></td>
                    <td>{{ number_format($mainamount,2,'.',',')  }}</td>
                </tr>

{{--                @foreach($transitions as $transition)--}}
{{--                    <tr class="">--}}
{{--                        <td colspan="4" class="text-end">{{$transition->name}}</td>--}}
{{--                        <td colspan="1"></td>--}}
{{--                        <td>{{ $transition->price  }}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}

                <tr>
                    <td colspan="2"></td>
                    <td colspan="" class="text-center fw-bold">ငွေလွှဲ</td>
                    <td colspan="2"></td>
                    <td class="fw-bold">{{ $totaltransition->totaltranprice }}</td>
                </tr>

                <tr>
                    <td colspan="2" class="bg-primary-subtle"></td>
                    <td colspan="" class="text-center fw-bold bg-primary-subtle">Final Amount</td>
                    <td colspan="2" class="bg-primary-subtle"></td>
                    <td class="fw-bold bg-primary-subtle">{{ number_format($final_amount,2,'.',',') }}</td>
                </tr>


                </tbody>
            </table>

        </div>

    </div>


@endsection

@section('modal')

@endsection

@section('js')

    <script type="text/javascript">



        $(document).ready(function() {

            $.ajaxSetup({
                headers:{
                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                }
            });

        });
    </script>

@endsection
