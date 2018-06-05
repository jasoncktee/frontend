<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <title>RESOURCE MANAGEMENT SYSTEM</title>
    <link href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css" media="screen" rel="stylesheet" type="text/css" />
    <style type="text/css">
        #container {
            margin: 10px;
            border: 1px solid #D0D0D0;
            box-shadow: 0 0 8px #D0D0D0;
        }

        .form_label {
            width: 100px;
        }
    </style>
</head>
<body onload="pageLoad()">
    <div id="container">
        <h1>RESOURCE MANAGEMENT SYSTEM</h1>

        <table id="table" border=1>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Staff No.</th>
                <th>Phone Number</th>
                <th>Gender</th>
            </tr>
        </table>
        <span id="textLabel"></span><br/>
        <button type="button" class="btn btn-primary  btn-sm" data-toggle="modal" data-target="#exampleModal">
                Add New Resource
        </button>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="addForm" class="form-horizontal">
                    <div class="modal-header">
                        <h5 class="modal-title">Add New Resource</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label class="form_label">Name *:</label>
                            <input id="inp_name" type="text" name="name" required="true"/>
                        </div>
                        <div>
                            <label class="form_label">Age :</label>
                            <input id="inp_age" type="text" name="age"/>
                        </div>
                        <div>
                            <label class="form_label">Staff No *:</label>
                            <input id="inp_staffno" type="text" name="staffno" required="true"/>
                        </div>
                        <div>
                            <label class="form_label">Phone No :</label>
                            <input id="inp_phoneno" type="text" name="phoneno"/>
                        </div>
                        <div>
                            <label class="form_label">Address * :</label>
                            <textarea id="address" name="address" rows="3" cols="30" required="true"></textarea>
                        </div>
                        <div>
                            <label class="form_label">Gender * :</label>
                            <input type="radio" name="gender" value="male" checked> Male
                            <input type="radio" name="gender" value="female"> Female
                        </div>
                        <div>
                            <label class="form_label">State * :</label>
                            <select id="state" required>
                                <option value="perak">Perak</option>
                                <option value="selangor">Selangor</option>
                                <option value="kedah">Kedah</option>
                                <option value="perlis">Perlis</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="addBtn" class="btn btn-primary">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url()?>assets/vendor/jquery/dist/jquery.js" ></script>
    <script type="text/javascript" src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.bundle.min.js" ></script>

    <script type="text/javascript">
        function pageLoad() {
            $.post('<?php echo base_url()?>/resource/listresource', {
                }, function(_result) {
                    // $decode = json_decode(_result, TRUE);
                    $data = jQuery.parseJSON( _result ).data;

                    $.each($data, function(key, val) {
                        $('#table').append('<tr><td class="rowCell" id="'+val.id+'"><a href="#" onclick="cellFunction('+val.id+'); return true;">'+val.name+'</a></td><td>'+val.age+'</td><td>'+val.staffno+'</td><td>'+val.phoneno+'</td><td>'+val.gender+'</td></tr>');
                    });
                });
        }

        function cellFunction(val) {
            console.log(val);
            $.post('<?php echo base_url()?>/resource/findresource', {
                'id' : val
            }, function(_result) {
                console.log(_result);
            });
        }

        $(function (){
            $('#addForm').submit(function(event) {
                // event.preventDefault();

                var name = $('#inp_name').val();
                var age = $('#inp_age').val();
                var staffno = $('#inp_staffno').val();
                var phoneno = $('#inp_phoneno').val();
                var address = $('#address').val();
                var gender = $('input[name=gender]:checked').val();
                var state = $('#state').val();

                $.post('<?php echo base_url()?>/resource/addservice', {
                    'name' : name,
                    'age' : age,
                    'staffno' : staffno,
                    'phoneno' : phoneno,
                    'address' : address,
                    'gender' : gender,
                    'state' : state
                }, function(_result) {
                    console.log(_result);
                    $('#textLabel'.html(_result.message));
                });

            });
        });

        $('.rowCell').click(function () {
            var rowid = $(this).attr('id');
            console.log(rowid);
        });
    </script>
</body>
</html>