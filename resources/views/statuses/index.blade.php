@extends('layouts.adminindex')
@section('content')
    <div class="container-fluid">
        <div class="col-md-12 ">

            <form id="createform" action="" method="POST">
                <div class="row align-items-end">
                    <div class="col-md-6 form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control form-control-sm" placeholder="Enter Item Name" />
                    </div>

                    <div class="col-md-6">
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
                    <th>By</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                </thead>
                <tbody>

{{--                    <tr>--}}
{{--                        <td>1</td>--}}
{{--                        <td>Shwe</td>--}}
{{--                        <td>Admin</td>--}}
{{--                        <td>12 Dec 2956</td>--}}
{{--                        <td>12 Dec 2956</td>--}}
{{--                        <td>--}}
{{--                            <a href="javascript:void(0);" class="me-2"><i class="fas fa-edit"></i></a>--}}
{{--                            <a href="javascript:void(0);" class="text-danger"><i class="fas fa-trash-alt"></i></a>--}}
{{--                        </td>--}}
{{--                    </tr>--}}

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
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" id="editname" class="form-control form-control-sm" value="{{old('name')}}" />
                                </div>
                            </div>

                            <div class="col-md-4 text-end">
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
                    url:"{{ route('statuses.store')  }}",
                    type:"POST",
                    dataType:"json",
                    data:$("#createform").serialize(),
                    success:function(response){
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
                    url: "{{ route('statuses.fetchalldatas') }}",
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
                                    <td>${data.user.name}</td>
                                    <td>${data.formatcreated}</td>
                                    <td>${data.formatupdated}</td>
                                    <td>
                                        <a href="javascript:void(0);" class="me-2 edit-btns" data-bs-toggle="modal" data-bs-target="#editmodal" data-id="${data.id}" data-name="${data.name}"><i class="fas fa-edit"></i></a>
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

                let getid = $(this).data('id');
                $("#formaction").attr('data-id',getid);

                $("#editmodal").modal('show');
            });

            $("#formaction").submit(function (e){
                e.preventDefault();

                const getid = $("#formaction").attr('data-id');

                $.ajax({
                    url: `/statuses/${getid}`,
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
                            url: `statuses/${getid}`,
                            type: "DELETE",
                            dataType: "json",
                            data: {"id":getid},
                            success: function(response){

                                Swal.fire({
                                    title: "Deleted!",
                                    text: "Your file has been deleted.",
                                    icon: "success"
                                });

                                fetchalldatas();

                            }
                        });


                    }
                });


            });
            // End Delete Btn


        });
    </script>

@endsection
