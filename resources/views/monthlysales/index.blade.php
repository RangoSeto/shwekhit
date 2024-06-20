@extends('layouts.adminindex')
@section('content')
    <div class="container-fluid">

        <div class="row d-flex">
            <div class="col-md-6">

                @foreach($stockins as $stockin)
                    <a href="{{ route('monthlysales.show', ['date'=>Carbon\Carbon::create($stockin->year,$stockin->month)->format('F Y')]) }}" class="nav-link pointer bg-white p-4 mt-3" data-date="{{Carbon\Carbon::create($stockin->year,$stockin->month)->format('F Y')}}">
                        <div class="fs-5 fw-semibold">
                            <span>Monthly Sales for</span> <span class="fst-italic text-primary">{{ Carbon\Carbon::create($stockin->year,$stockin->month)->format('F Y')}}</span> Date.
                        </div>
                    </a>
                @endforeach

            </div>

            <div class="col-md-6">
                @foreach($stockins as $stockin)
                    <a href="{{ route('monthlysales.transition', ['date'=>Carbon\Carbon::create($stockin->year,$stockin->month)->format('F Y')]) }}" class="nav-link pointer bg-white p-4 mt-3" data-date="{{Carbon\Carbon::create($stockin->year,$stockin->month)->format('F Y')}}">
                        <div class="fs-5 fw-semibold">
                            <span>Bank Transfer for</span> <span class="fst-italic text-primary">{{ Carbon\Carbon::create($stockin->year,$stockin->month)->format('F Y')}}</span> Date.
                        </div>
                    </a>
                @endforeach
            </div>
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

            // Start Create Form
            $("#createform").submit(function(e){
                e.preventDefault();

                $.ajax({
                    url:"{{ route('items.store')  }}",
                    type:"POST",
                    dataType:"json",
                    data:$("#createform").serialize(),
                    success:function(response){
                        console.log(response);
                        if(response){
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Created Successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#createform").trigger("reset");

                            fetchalldatas();

                        }
                    }
                });
            });
            // End Create Form


            // Start fetch all datas
            function fetchalldatas(){
                $.ajax({
                    url: "{{ route('items.fetchalldatas') }}",
                    type: "GET",
                    dataType: "json",
                    success:function(response){
                        let datas = response.data;
                        let html = '';

                        datas.forEach(function(data,idx){
                            html += `
                                <tr>
                                    <td>${++idx}</td>
                                    <td>${data.name}</td>
                                    <td>${data.price}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" id="status-btns" class="form-check-input" ${data.status_id === 3 ? 'checked' : ''} value="${data.status_id}" data-id="${data.id}"/>
                                        </div>
                                    </td>
                                    <td>${data.user.name}</td>
                                    <td>${data.formatcreated}</td>
                                    <td>${data.formatupdated}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="me-2 edit-btns" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}" data-price="${data.price}" data-status_id="${data.status_id}"><i class="fas fa-edit"></i></a>
                                        <a href="javascript:void(0);" class="text-danger delete-btns" data-id="${data.id}" data-name="${data.name}"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            `;
                        });

                        $("#mytable tbody").html(html);

                    },
                    error:function(response){
                        console.log(response);
                    }
                });
            }
            // fetchalldatas();
            // End Fetch all datas


            // Start Edit Btn
            $(document).on('click',".edit-btns",function (){
                $("#editname").val($(this).data('name'));
                $("#editprice").val($(this).data('price'));
                $("#editstatus_id").val($(this).data('status_id'));

                let getid = $(this).data('id');
                $("#formaction").attr('data-id',getid);

                $("#editmodal").modal('show');
            });

            $("#formaction").submit(function (e){
                e.preventDefault();

                const getid = $("#formaction").attr('data-id');

                $.ajax({
                    url: `/items/${getid}`,
                    type: "PUT",
                    dataType:"json",
                    data: $(this).serialize(),
                    success: function (response){
                        if(response){
                            Swal.fire({
                                position: "top-end",
                                icon: "success",
                                title: "Created Successfully",
                                showConfirmButton: false,
                                timer: 1500
                            });
                            $("#editmodal").modal('hide');
                            $("#formaction").trigger("reset");
                            fetchalldatas();

                        }
                    }
                });
            });
            // End Edit Btn

            // Start Delete btn
            $(document).on('click','.delete-btns',function (){
                let getid = $(this).data('id');
                let getname = $(this).data('name');

                Swal.fire({
                    title: "Are you sure?",
                    text: `You won't be able to revert this ${getname}!`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {

                        $.ajax({
                            url: `items/${getid}`,
                            type: "DELETE",
                            dataType: "json",
                            data: {"id":getid},
                            success: function(response){

                                console.log(response);
                                if(response){
                                    Swal.fire({
                                        title: "Deleted!",
                                        text: "Your file has been deleted.",
                                        icon: "success"
                                    });
                                    fetchalldatas();
                                }

                            }
                        });


                    }
                });


            });
            // End Delete Btn


            // Start Change Status Btn
            $(document).on('click','#status-btns',function (){
                const getid = $(this).data('id');
                let getstatus = $(this).prop('checked') ? 3 : 4;

                $.ajax({
                    url:`/itemsstatus`,
                    type: "GET",
                    dataType: "json",
                    data: {"id":getid,"status_id":getstatus},
                    success: function (response){
                        console.log(response);

                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Status Change Successfully",
                            showConfirmButton: false,
                            timer: 1000
                        });

                        fetchalldatas();
                    }
                });

            });
            // End Change Status Btn

        });
    </script>

@endsection
