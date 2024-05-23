@extends('layouts.adminindex')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12 ">

            <form id="createform" action="" method="">
                <div class="row align-items-end">
                    <div class="col-lg-4 col-md-6 form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Enter Item Name" />
                    </div>

                    <div class="col-lg-4 col-md-6 form-group mb-2">
                        <label for="price">Price</label>
                        <input type="number" name="price" id="price" class="form-control form-control-sm" placeholder="Enter Price" />
                    </div>

                    <div class="col-lg-2 col-md-6 mb-2">
                        <label for="status_id">Status</label>
                        <select name="status_id" id="status_id" class="form-select form-select-sm">
                            @foreach($statuses as $status)
                                <option value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-lg-2 col-md-6 text-end mb-2">
                        <button type="reset" class="btn btn-sm btn-secondary me-2">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-primary">Create</button>
                    </div>
                </div>
            </form>

        </div>

        <hr>

        <div class="col-md-12">

            <table id="mytable" class="table table-hover border">
                <thead class="">
                    <th>No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </thead>
                <tbody>


                </tbody>
            </table>

        </div>

    </div>


@endsection

@section('modal')
    {{--    START MODEL AREA--}}
    {{--        Start Edit Model--}}
    <div id="editmodal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h6>Edit Form</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <form id="formaction" action="">
                        <div class="row align-items-end" >
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="editname" class="form-control form-control-sm" value="{{old('name')}}" />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="number" name="price" id="editprice" class="form-control form-control-sm" value="{{old('price')}}" />
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 mb-2">
                                <label for="status_id">Status</label>
                                <select name="status_id" id="editstatus_id" class="form-select form-select-sm">
                                    @foreach($statuses as $status)
                                        <option value="{{$status->id}}">{{$status->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 text-end">
                                <div class="">
                                    <button type="button" class="btn btn-sm btn-secondary ">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary ">Update</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{--        End Edit Model--}}
    {{--    END MODEL AREA--}}
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
            fetchalldatas();
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
