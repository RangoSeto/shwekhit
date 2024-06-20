@extends('layouts.adminindex')
@section('content')
    <div class="container-fluid">


        <div class="col-md-12">

            <table id="mytable" class="table table-responsive table-hover border">
                <thead class="">
                    <th>No</th>
                    <th>Customer Name</th>
                    <th>PaymentType</th>
                    <th>Price</th>
                    <th>Transition Date</th>
                </thead>
                <tbody>

                @forelse($transitions as $idx=>$transition)
                    <tr id="delete_{{$transition->id}}">
                        <td>{{++$idx}}</td>
                        <td>{{$transition->name}}</td>
                        <td>{{$transition->paymenttype->name}}</td>
                        <td>{{ number_format($transition->price ,2,'.',',')  }}</td>
                        <td>{{date('d/m/Y h:m:s A',strtotime($transition->created_at))}}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center fw-bold bg-info-subtle">No Data</td>
                    </tr>
                @endforelse

                <tr class="">
                    <td colspan="3" class="text-center fw-bold">Total Transition Amount</td>
                    <td class="bg-primary-subtle fw-bold">{{ number_format($totaltransition->totaltranprice,2,'.',',') }}</td>
                    <td></td>
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
