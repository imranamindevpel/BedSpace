@extends('layouts.master')

@section('title', 'Users')

@section('content')
<style>
    td{
        padding: 2px 10px;
    }
    .sorting{
        text-transform: uppercase; 
    }
</style>
{{$role = Auth::user()->role_id}}
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    
    <div class="modal fade" id="addUserData">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add User Details</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
              <form enctype="multipart/form-data" method="post">
                <input type="hidden" id="user_id">
                <div class="form-group">
                    <input type="file" class="form-control" placeholder="Upload Image" id="image">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Name" id="name">
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="Enter Email" id="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" placeholder="Enter Password" id="password">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Phone" id="phone">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Gender" id="gender">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Address" id="address">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Enter Bio" id="bio">
                </div>
            </form>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="saveUser(event)">Save User</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <div class="modal fade" id="addAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-notify modal-danger" role="document">
            <div class="modal-content text-center">
            <div class="modal-header d-flex justify-content-center">
                <p class="heading">Add Address</p>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <input type="hidden" id="userId">
                    <input type="text" class="form-control" placeholder="Address#1" id="address_1">
                </div>
                <div class="form-group">
                    <!-- <input type="hidden" id="userId"> -->
                    <input type="text" class="form-control" placeholder="Address#2" id="address_2">
                </div>
                <div class="form-group">
                    <!-- <input type="hidden" id="userId"> -->
                    <input type="text" class="form-control" placeholder="City" id="city">
                </div>
                <div class="form-group">
                    <!-- <input type="hidden" id="userId"> -->
                    <input type="text" class="form-control" placeholder="Country" id="country">
                </div>
                <div class="form-group">
                    <!-- <input type="hidden" id="userId"> -->
                    <input type="text" class="form-control" placeholder="Post Code" id="post_code">
                </div>
            </div>
            <div class="modal-footer flex-center">
                <a href="" class="btn btn-primary" onclick="saveAddress(event)">Save Address</a>
                <a type="button" class="btn  btn-outline-danger waves-effect" data-dismiss="modal">No</a>
            </div>
            </div>
        </div>
    </div>
    <!-- View Address Modal -->
    <div class="modal fade" id="viewAddress" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel3" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-notify modal-danger" role="document">
            <div class="modal-content">
            <div class="modal-body" id="addressInfo">
            </div>
            <div class="modal-footer flex-center">
                <a type="button" class="btn  btn-outline-danger waves-effect" data-dismiss="modal">Cancel</a>
            </div>
            </div>
        </div>
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <?php if($role == 1) { ?>
                <button type="button" class="btn btn-sm btn-info float-right" data-toggle="modal" data-target="#addUserData" onclick="addUserData()">
                Add User
                </button>
                <?php } ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <!-- <table id="example1" class="table table-bordered table-striped">
                </table> -->
                <table id="table1" class="display">
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

  <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            list();
        });
        
        function reset(){
            document.getElementById('user_id').value= "";
            document.getElementById('image').value= "";
            document.getElementById('name').value= "";
            document.getElementById('email').value= "";
            document.getElementById('password').value= "";
            document.getElementById('phone').value= "";
            document.getElementById('gender').value= "";
            document.getElementById('address').value= "";
            document.getElementById('bio').value= "";
        }
        
        function list() { 
            $.ajax({
                url: "/users/get_users_data",
                type: "get",
                dataType: "json",
                success: function(response) {
                    var columns = [];
                    for (var key in response.data[0]) {
                        var header = key.replace(/_/g, ' '); // Replace underscores with spaces
                        columns.push({"title": header, "data": key});
                    }
                    $('#table1').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            "url": "/users/get_users_data",
                            "type": "get"
                        },
                        "columns": columns
                    });
                }
            });
        }
        
        function addUserData() {
            reset();
        }
        function saveUser(event) {
            event.preventDefault();
            var user_id = $('#user_id').val();
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var password = $('#password').val();
            var gender = $('#gender').val();
            var address = $('#address').val();
            var bio = $('#bio').val();

            // Create a new FormData object to include the image file
            var formData = new FormData();
            formData.append('user_id', user_id);
            formData.append('image', $('#image')[0].files[0]);
            formData.append('name', name);
            formData.append('email', email);
            formData.append('phone', phone);
            formData.append('password', password);
            formData.append('gender', gender);
            formData.append('address', address);
            formData.append('bio', bio);

            if(user_id == 0){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "/users/create_user",
                    success: function (data) {
                        if (data.success) {
                            alert(data.success);
                            $('#addUserData').modal('hide');
                            list();
                        }
                    }
                })
            }else{
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'post',
                    data: formData,
                    processData: false,
                    contentType: false,
                    url: "/users/update_user",
                    success: function (data) {
                        if (data.success) {
                            alert(data.success);
                            $('#addUserData').modal('hide');
                            list();
                        }
                    }
                })
            }
        }
        
        function viewUser($id) {
            $('#password').hide();
            var id = $id;
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                },
                url: "users/get_single_user",
                success: function (data) {
                    document.getElementById('name').value= data.name;
                    document.getElementById('email').value= data.email;
                    // document.getElementById('phone').value= data.profile.phone;
                    // document.getElementById('gender').value= data.profile.gender;
                    // document.getElementById('address').value= data.profile.address;
                    // document.getElementById('bio').value= data.profile.bio;
                }
            })
        }
        function editUser(id) {
            $('#password').hide();
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                },
                url: "users/get_single_user",
                success: function (data) {
                    document.getElementById('name').value= data.name;
                    document.getElementById('email').value= data.email;
                    // document.getElementById('phone').value= data.profile.phone;
                    // document.getElementById('gender').value= data.profile.gender;
                    // document.getElementById('address').value= data.profile.address;
                    // document.getElementById('bio').value= data.profile.bio;
                }
            })
        }
        function deleteUser($id) {
            var id = $id;
            $.ajax({
                type: 'get',
                data: {
                    id: id,
                },
                url: "users/delete_user",
                success: function (data) {
                    if (data.success) {
                        alert(data.success);
                        list();
                    }
                }
            })
        }
        function addAddress(id) {
            document.getElementById("userId").value = id;
        }
        function saveAddress(event) {
            event.preventDefault();
            var formData = new FormData();
            formData.append('userId', $('#userId').val());
            formData.append('address_1', $('#address_1').val());
            formData.append('address_2', $('#address_2').val());
            formData.append('city', $('#city').val());
            formData.append('country', $('#country').val());
            formData.append('post_code', $('#post_code').val());

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'post',
                data: formData,
                processData: false,
                contentType: false,
                url: "users/save_address",
                success: function (data) {
                    if (data.success) {
                        alert(data.success);
                        $('#addAddress').modal('hide');
                        list();
                    }
                }
            });
        }
        function viewAddress(id) {
            $.ajax({
                url: "/users/get_user_addresses",
                type: 'get',
                data: {
                id: id,
                },
                success: function(response) {
                var data = JSON.parse(response);
                var table = $('<table>').attr('id', 'addressTable').addClass('display');
                var thead = $('<thead>').append('<tr><th>No.</th><th>Address 1</th><th>Address 2</th><th>City</th><th>Country</th><th>Post Code</th></tr>');
                var tbody = $('<tbody>');
                for (var i = 0; i < data.length; i++) {
                    tbody.append('<tr><td>' + (i+1) + '</td><td>' + data[i].address_1 + '</td><td>' + data[i].address_2 + '</td><td>' + data[i].city + '</td><td>' + data[i].country + '</td><td>' + data[i].post_code + '</td></tr>');
                }
                table.append(thead).append(tbody);
                $('#addressInfo').html(table);
                $('#addressTable').DataTable();
                }
            });
        }
    </script>

@endSection()