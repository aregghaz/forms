@extends('page.index')

@section('title')

@endsection
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

@section('content')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        #sortable {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 60%;
        }

        #sortable li {
            margin: 0 3px 3px 3px;
            padding-left: 1.5em;
            font-size: 1.4em;
            height: 30px;
        }

        #sortable li span {
            position: absolute;
            margin-left: -1.3em;
        }

        .newName {
            display: inline-block;
        }

        .newForm {
            display: none;
        }

        #createField, #createForm, #formName2 {
            margin-bottom: 20px;
        }

        #createForm, #city, #formName2, .w3-bar {
            margin-top: 20px;

        }

        .city {
        }
    </style>
    <script>
        var formNameArray = [];
        var formNameArray2 = [];
        var formDate = [];

        $(function () {
            $("#sortable").sortable();
            $("#sortable").disableSelection();
        });
    </script>
    <div class="col-md-offset-2 col-md-6">
        <div class="w3-bar w3-black">
            <button class="w3-bar-item w3-button" onclick="openCity('create')">Create Form</button>
            <button class="w3-bar-item w3-button" onclick="openCity('edit')">Edit submissions forms</button>
            <button class="w3-bar-item w3-button" id="seeSubmission" onclick="openCity('see')">See submissions forms
            </button>

        </div>
        <div id="create" class="city">
            <h2>Create Form</h2>
            <select name="createField" title="Create Field" id="createField">
                <option value="">Select</option>
                <option value="input">input</option>
            </select>

            <div class="col-md-12 " id="createForm">

            </div>
            <form action="{{ route('submit') }}" method="post">
                <div class="col-md-12 " id="previewForm">
                </div>

                <div class="newForm">
                    <input type="text" name="formName" id="formName" placeholder="Form Name">
                    <button type="submit">save</button>
                    <input type="hidden" name="_token" id="token" value="{{  Session::token() }}">
                </div>

            </form>
        </div>
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <input type="text" id="changeInputName" title="input Name" required>
                    <input type="hidden" id="inputId">
                    <button id="submitChanges"></button>
                </div>
            </div>
        </div>
        <div id="edit" class="city" style="display:none">
            <select name="" id="formName2" title="">
                <option>Select Form</option>
                @foreach($forms as $form)
                    <script>
                        formNameArray['<?php echo $form->formName ?>'] = $.parseJSON('<?php echo $form->field ?>');

                    </script>
                    <option value="{{ $form->formName }}" title="{{ $form->id }}">{{ $form->formName }}</option>

                @endforeach
            </select>
            <div>
                <div class="col-md-6">
                    <div id="divFormName">

                    </div>
                    <ul id="sortable">

                    </ul>
                </div>
                <div class="col-md-3">
                    <input type="text" id="createNewField" placeholder="create new field">
                    <button id="createNew">Create</button>
                </div>
            </div>

        </div>
        <div id="see" class="city" style="display:none">
            @if(!empty($answers))
                @foreach($answers as $answer)
                    <script>
                        formNameArray2['<?php echo $answer->formName ?>'] = $.parseJSON('<?php echo $answer->field_answers ?>');
                    </script>


                @endforeach
            @endif
            <select name="" id="formName3" title="">
                <option>Select Form</option>
                @foreach($forms as $form)
                    <script>
                        formNameArray['<?php echo $form->formName ?>'] = $.parseJSON('<?php echo $form->field ?>');
                    </script>
                    <option value="{{ $form->formName }}" title="{{ $form->id }}">{{ $form->formName }}</option>

                @endforeach
            </select>
            <div id="createFormsSubmited">

            </div>
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
            if (userChose == 'input') {
                $('#createForm').empty();
                $('.newForm').css('display', 'block')
                $('#createForm').append('<input type="text" id="nameField" placeholder="Field Name"><button type="submit" id="crateFieldByName">Create</button>')
            }
            $('#crateFieldByName').on('click', function () {
                var nameField = $('#nameField').val();
                var previewForm = $('#previewForm');

                if (nameField == 'password' || nameField == 'Password') {
                    previewForm.append('   <div class="form-group">' +
                            '                <label for="inputEmail3" class="col-sm-2 control-label">Password</label>' +
                            '                <div class="col-sm-10">' +
                            '                    <input type="password" class="form-control" name="' + nameField + '"  placeholder="Password">' +
                            '                </div>' +
                            '            </div>');
                } else {
                    previewForm.append('   <div class="form-group">' +
                            '                <label for="inputEmail3" class="col-sm-2 control-label">' + nameField + '</label>' +
                            '                <div class="col-sm-10">' +
                            '                    <input type="text" class="form-control" name="' + nameField + '"  placeholder="' + nameField + '">' +
                            '                </div>' +
                            '            </div>');
                }
                previewForm.append('<input type="hidden" name="_token" value="{{  Session::token() }}">');
                $('#nameField').val('');
            })
        });
        $(document).ready(function () {
            $('#formName2').on('change', function () {
                var drawDiv = $('#sortable');
                drawDiv.empty();
                var formDiv = $('#formName2');
                var formName = formDiv.val();
                var formId = formDiv.find(':selected').attr('title');
                var formLenght = formNameArray[formName].length;
                var formItem = formNameArray[formName];
                drawDiv.append('<input type="hidden" id="formId" value="' + formId + '"> ');
                $('#divFormName').append('<input type="text" id="newFormName" value="' + formName + '"> ');
                for (var i = 0; i < formLenght; i++) {
                    drawDiv.append(' <li class="ui-state-default" ><p class="newName" id="input' + i + '">' + formItem[i] + '</p><i class="glyphicon glyphicon-trash"></i><i data-toggle="modal" data-target=".bs-example-modal-sm" class="glyphicon glyphicon-edit"></i></li>')

                }
                drawDiv.append('<input type="button" id="saveChanges"  value="SAVE"> ');
                $('#createNew').on('click', function () {
                    var newInputName = $('#createNewField').val()

                    drawDiv.prepend(' <li class="ui-state-default" ><p class="newName" id="input' + $('.newName').length + 1 + '">' + newInputName + '</p><i class="glyphicon glyphicon-trash"></i><i data-toggle="modal" data-target=".bs-example-modal-sm" class="glyphicon glyphicon-edit"></i></li>')
                    $('.glyphicon-trash').on('click', function (event) {
                        $(event.target.parentNode).remove()

                    });
                    $('.glyphicon-edit').on('click', function (event) {
                        console.log($(event.target.parentNode.firstChild).attr('id'));
                        $('#inputId').val($(event.target.parentNode.firstChild).attr('id'));
                        $('#changeInputName').val($(event.target.parentNode).text())
                    });
                })
                $('.glyphicon-trash').on('click', function (event) {
                    $(event.target.parentNode).remove()

                });
                $('.glyphicon-edit').on('click', function (event) {
                    console.log($(event.target.parentNode.firstChild).attr('id'));
                    $('#inputId').val($(event.target.parentNode.firstChild).attr('id'));
                    $('#changeInputName').val($(event.target.parentNode).text())
                });
                $('#submitChanges').on('click', function () {
                    var inoutId = '#' + $('#inputId').val();
                    var newField = $('#changeInputName').val();
                    $(inoutId).text(newField);
                    $('.bs-example-modal-sm').modal('hide');
                });
                $('#saveChanges').on('click', function () {
                    var newData = [];
                    var newInput = $('.newName')
                    for (var j = 0; j < newInput.length; j++) {
                        newData[j] = newInput.eq(j).text()
                    }
                    var newFormName = $('#newFormName').val();
                    var newFormNameId = $('#formId').val();
                    $.ajax({
                        type: 'POST',
                        url: "{{ route('saveChanges') }}",
                        data: {formName: newFormName, formId: newFormNameId, data: newData, _token: $('#token').val()},
                        success: function (result) {

                        }
                    });
                })

            })

        });

        $('#formName3').on('change', function () {
            var drawDiv = $('#createFormsSubmited');
            drawDiv.empty();
            var formDiv = $('#formName3');
            var formName = formDiv.val();
            var formId = formDiv.find(':selected').attr('title');
            var formLenght = formNameArray[formName].length;
            var formItem = formNameArray[formName];
            var formAnswer = formNameArray2[formName];

            if (formAnswer !== undefined) {

                drawDiv.append('<input type="hidden" id="formId" value="' + formId + '"> ');
                $('#createFormsSubmited').append('<input type="text" id="newFormName" value="' + formName + '"> ');
                for (var i = 0; i < formLenght; i++) {
                    drawDiv.append('<div class="form-group"><label for="' + formItem[i] + '">' + formItem[i] + '</label><input type="text" class="form-control" name="' + formItem[i] + '" id="' + formItem[i] + '" value="' + formAnswer[i] + '"> </div>')

                }
            } else {
                drawDiv.append('<p>you not submited this form</p>')
            }


        })
    </script>
@endsection
