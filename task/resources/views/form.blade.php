@extends('page.index')

@section('title')

@endsection

@section('content')
    <div class="col-md-offset-2 col-md-6">
        <div class="w3-bar w3-black">
            <button class="w3-bar-item w3-button" onclick="openCity('create')">Create Form</button>
            <button class="w3-bar-item w3-button" onclick="openCity('see')">See submissions forms</button>

        </div>
        <div id="create" class="city">
            <h2>Create Form</h2>
            <select name="createField" title="Create Field" id="createField">
                <option value="">Select</option>
                <option value="input">input</option>
            </select>

        <div class="col-md-12 " id="createForm">

        </div>
            <div class="col-md-12 " id="previewForm">

        </div>


        </div>






        <div id="see" class="city" style="display:none">
            <h2>Paris</h2>
            <p>Paris is the capital of France.</p>
        </div>

    </div>

    <script>
        function openCity(cityName) {
            var i;
            var x = document.getElementsByClassName("city");
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            document.getElementById(cityName).style.display = "block";
        }
        $('#createField').on('change', function () {
           var userChose = $('#createField').val();
           if(userChose == 'input') {
$('#createForm').append('<input type="text" id="nameField" ><button type="submit" id="crateFieldByName">Create</button>')
           }
            $('#crateFieldByName').on('click', function () {
                var nameField = $('#nameField').val();
                if(nameField == 'password' || nameField == 'Password') {
                    $('#previewForm').append('   <div class="form-group">' +
                        '                <label for="inputEmail3" class="col-sm-2 control-label">Password</label>' +
                        '                <div class="col-sm-10">' +
                        '                    <input type="password" class="form-control" name="email"  placeholder="Password">' +
                        '                </div>' +
                        '            </div>');
                }else {
                    $('#previewForm').append('   <div class="form-group">' +
                        '                <label for="inputEmail3" class="col-sm-2 control-label">'+ nameField +'</label>' +
                        '                <div class="col-sm-10">' +
                        '                    <input type="email" class="form-control" name="email"  placeholder="'+nameField+'">' +
                        '                </div>' +
                        '            </div>')  ;
                }
                console.log($("#previewForm > div").length);

            })
        })


    </script>
@endsection
