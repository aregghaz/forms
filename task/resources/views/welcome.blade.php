@extends('page.index')

@section('title')

@endsection

@section('content')
    <style>
        .formButton {
            display: none;
        }

        #formName {
            margin: 20px 0;

        }
    </style>
    <script>
        var formNameArray = [];
    </script>


    <div class="col-md-offset-3 col-md-6 ">
        <div class="col-md-4">
            <select name="" id="formName" title="">
                <option value="" >Select Form</option>
                @foreach($forms as $form)
                    <script>
                        formNameArray['<?php echo $form->formName ?>'] = $.parseJSON('<?php echo $form->field ?>');
                    </script>
                    <option value="{{ $form->formName }}" title="{{ $form->id }}">{{ $form->formName }}</option>
                @endforeach
            </select>


        </div>
    </div>
    <div class="col-md-offset-3 col-md-6 ">
        <form method="post" action="{{ route('submitForm') }}">
            <div id="drawDiv">

            </div>

            <div class="formButton">
                <input type="hidden" name="_token" value="{{  Session::token() }}">
                <button type="submit" class="btn btn-default">Submit</button>
            </div>

        </form>
    </div>
<div class="col-md-3">
    <p>for login Admin Area use this <a href="/login">Link</a></p>

</div>
    </div>

    <script>
        $('#formName').on('change', function () {
            $('.formButton').css('display', 'block')
            var drawDiv = $('#drawDiv');
            drawDiv.empty();
            var formDiv = $('#formName');
            var formName = formDiv.val();
            var formId = formDiv.find(':selected').attr('title');
            var formLenght = formNameArray[formName].length;
            var formItem = formNameArray[formName];
            drawDiv.append('<input type="hidden" name="formId" value="' + formId + '"> ');
            for (var i = 0; i < formLenght; i++) {
                drawDiv.append('<div class="form-group"><label for="' + formItem[i] + '">' + formItem[i] + '</label><input type="text" class="form-control" name="' + formItem[i] + '" id="' + formItem[i] + '" placeholder="' + formItem[i] + '"> </div>')

            }
        })
    </script>
@endsection