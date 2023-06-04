<html>
    <head>
        <title>CRUD</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="w-75">
                    <form action="javascript:void(0)" id="register" class="register-form"  method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="userid" name="id" value="0">
                        <div class="row"> 
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <div class="@error('name') is-invalid @enderror"> 
                                        <input type="text" class="form-control " name="name" id="name" value="{{old('name')}}">
                                    </div>
                                    <div id="name" class="invalid-feedback">
                                        @error('name')
                                         {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <div class="@error('email') is-invalid @enderror">
                                        <input type="email" class="form-control " name="email" value="{{old('email')}}"  id="email">
                                    </div>
                                    <div id="email" class="invalid-feedback">
                                        @error('email')
                                         {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <div class=" @error('phone') is-invalid @enderror">
                                        <input type="text" minlength="10" maxlength="10" class="form-control" name="phone" id="phone" {{old('phone')}}>
                                    </div>
                                    <div id="phone" class="invalid-feedback">
                                        @error('phone')
                                         {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="mb-3">Gender </div>
                                <div class="mb-3 d-flex"> 
                                    <div class="me-2 @error('gender') is-invalid @enderror">
                                        <input class="form-check-input" type="radio" name="gender" id="male" value="male">
                                    </div>
                                    <label class="me-2 form-check-label" for="male"> male</label>
                                    <div class="me-2 @error('gender') is-invalid @enderror">
                                        <input class="form-check-input" type="radio" name="gender" id="female" value="female">
                                    </div>
                                    <label class="me-2 form-check-label" for="female" id="gen"> female </label>
                                    <div id="gender" class="invalid-feedback">
                                        @error('gender')
                                         {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="education" class="form-label">Education</label>
                                </div>
                                <div class="mb-3">
                                    <div id="educ" class="@error('education') is-invalid @enderror">
                                        <select class="form-select " name="education" aria-label="Default select example">
                                            <option value=" ">Select</option>
                                            @foreach ($education as $edu)                                            
                                                <option value="{{$edu->id}}" {{ (old("education") == $edu->id ? "selected":"") }}>{{$edu->edu_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div id="education" class="invalid-feedback">
                                        @error('education')
                                         {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-1">
                                    <label for="Hobby" class="form-label">Hobby</label>
                                </div>
                                <div class="mb-3 d-flex hobby" >
                                    <div class="form-check @error('hobby') is-invalid @enderror" id="hobbyCheckbox">
                                        <input class="me-2 form-check-input" name="hobby[]" type="checkbox" value="Cricket" id="Cricket" {{ (is_array(old('hobby')) && in_array(1, old('hobby'))) ? ' checked' : '' }}>
                                        <label class="me-2 form-check-label" for="Cricket">
                                        Cricket
                                        </label>
                                    </div>
                                    <div class="form-check @error('hobby') is-invalid @enderror">
                                        <input class="me-2 form-check-input " name="hobby[]" type="checkbox" value="Singing" id="Singing" {{ (is_array(old('hobby')) && in_array(2, old('hobby'))) ? ' checked' : '' }}>
                                        <label class="me-2 form-check-label" for="Singing">
                                        Singing
                                        </label>
                                    </div>
                                    <div class="form-check @error('hobby') is-invalid @enderror">
                                        <input class="me-2 form-check-input " name="hobby[]" type="checkbox" value="Travelling" id="x`" {{ (is_array(old('hobby')) && in_array(3, old('hobby'))) ? ' checked' : '' }}>
                                        <label class="me-2 form-check-label" for="Travelling">
                                        Travelling
                                        </label>
                                    </div>
                                    <div id="hobby" class="invalid-feedback">
                                        @error('hobby')
                                         {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                                    
                                    <div class="mb-3">
                                        <label for="Experience" class="form-label">Experience</label>
                                        <button class="btn btn-sm  btn-outline-primary" id="experiencesadd" type="button">+</button>
                                        <div class=" @error('experience') is-invalid @enderror">
                                            <input type="text" class="form-control mb-1" id="experience" name="experience[]">
                                        </div>
                                        <div id="insertColumn">
                                            
                                        </div>
                                        <div id="experience" class="invalid-feedback">
                                            @error('experience')
                                             {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-1">
                                        <label for="Picture" class="form-label">Picture</label>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group @error('picture') is-invalid @enderror">
                                            <input type="file" class="form-control picture"name="picture" value="{{old('picture')}}">
                                            
                                        </div>
                                        <div id="picture" class="invalid-feedback">
                                            @error('picture')
                                             {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="mb-3">
                                        <label for="message" class="form-label">Message</label>
                                        <div class="@error('message') is-invalid @enderror">
                                            <textarea class="form-control " placeholder="Leave a comment here" name="message" id="message" style="height: 100px" value="{{old('message')}}"></textarea>
                                        </div>
                                        <div id="message" class="invalid-feedback">
                                            @error('message')
                                             {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>                                
                            <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <form >
                <div class="d-flex">
                    <div class="input-group w-25">
                        <input type="text" class="form-control" placeholder="Search">
                        <span class="input-group-text" id="serchnameemail">&#x1F50D;</span>
                    </div>
                    <button type="button" class="btn btn-primary mx-3" value="clear">Clear</button>
                </div>
            </form>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>S NO.</th>
                        <th>Name</th>
                        <th>Hobby</th>
                        <th>Email</th>
                        <th>Picture</th>
                        <th>Action</th>
                    </thead> 
                    <tbody id="userdata">
                    </tbody>
                </table>
                <a href="javascript:void(0)" data-offset="0" class="loadMore" >Load more transactions <i class="fa-solid fa-chevron-down"></i></a>
            </div>
        </div>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            </script>
        <script>
    
$(document).on('submit','.register-form',function(e){
    var forms = document.querySelectorAll('.register-form');
    formValid=[];
    var isValid=$('input[name=gender]').is(":checked");
    if(isValid===false)
    {
        $('#gen').addClass('is-invalid');
        $('input[name=gender]').parent().find('.invalid-feedback').html('This Field is required');
    }
    else{
        $('#gen').removeClass('is-invalid');
        $('input[name=gender]').parent().find('.invalid-feedback').html('');
    }

    
    var IsChecked = $('input[name="hobby[]"]:checked').length > 0;
    if(IsChecked==false)
    {
        $('#hobbyCheckbox').addClass('is-invalid');
        $('#hobby').html('This Field is required');
    }

    var sel=$('select[name=education]').val();
    if(sel=='')
    {
        $('#educ').addClass('is-invalid');
    }
    // var isValid=$('input[name=hobby]').is(":checked");
    // if(isValid===false)
    // {
    //     $('#gen').addClass('is-invalid');
    //     $('input[name=gender]').parent().find('.invalid-feedback').html('This Field is required');
    // }
    $("form.register-form :input").each(function(){
        var input = $(this);
        console.log(input.attr('name'));
        if(input.val()=='' && input.attr('type')!=='submit' && input.attr('type')!=='button'  )
        {
                formValid.push(false);
                label=input.parent().find('label').text();
                input.parent().addClass('is-invalid');
                input.parent().find('.invalid-feedback').html('This Field is required'); 
        }else{
                if(input.attr('name')=='email')
                {
                    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
                    if (input.val().match(validRegex)) {
                        formValid.push(true);
                        input.parent().removeClass('is-invalid');
                    }else{
                            formValid.push(false);
                            $('#register').attr('disabled','true'); 
                            input.parent().addClass('is-invalid');
                            input.parent().find('.invalid-feedback').html('Not a valid mail address');  
                    }
                }
                if(input.attr('name')=='name')
                {
                    var validRegex =/^[a-zA-Z ]{2,30}$/;
                    if (input.val().match(validRegex)) {
                        formValid.push(true);
                        input.parent().removeClass('is-invalid');
                    }else{
                            formValid.push(false);
                            $('#register').attr('disabled','true'); 
                            input.parent().addClass('is-invalid');
                            input.parent().parent().find('.invalid-feedback').html('Not a valid Name');  
                    }
                }
                else if(input.attr('phone')=='phone')
                {
                    var validRegex =/^(\+\d{1,3}[- ]?)?\d{10}$/;
                    if (input.val().match(validRegex)) {
                        formValid.push(true);
                        input.parent().removeClass('is-invalid');
                    }else{
                            formValid.push(false);
                            $('#register').attr('disabled','true'); 
                            input.parent().addClass('is-invalid');
                            input.parent().parent().find('.invalid-feedback').html('Not a valid Phone Number');  
                    }
                }
                else if(input.val())
                {  
                    formValid.push(true);
                    input.parent().removeClass('is-invalid');
                }
                 
        }
    });
    // console.log(formValid);
    if(formValid.indexOf(false)==-1)
    {
        e.preventDefault();
        var form = this;
        $.ajax({
            url: "{{route('create')}}",
            method: "POST",
            data: new FormData(form),
            encType: "multipart/form-data",
            processData: false,
            dataType: 'JSON',
            contentType:false,
            success: function (response) {
                if(response.status===true)
                {
                    $('input[name=name]').val("");
                    $('input[name=email]').val("");
                    $('input[name=phone]').val("");
                    $('input[name="experience[]""]').val("");
                    $('input[name=picture').val("");
                    $('#message').val("");
                    $('input:checkbox').removeAttr('checked');
                    $('input:radio').removeAttr('checked');
                    alert(response.success);
                }
            }
        });
    }   
    return false;
});
            // $(document).ready(function(){
            //     $('#register').on('submit', function(e){
            //         e.preventDefault();
            //         var form = this;
            //      console.log($('#register').serialize());
            //             $.ajax({
            //                 url: "{{route('create')}}",
            //                 method: "POST",
            //                 data: new FormData(form),
            //                 encType: "multipart/form-data",
            //                 processData: false,
            //                 dataType: 'JSON',
            //                 contentType:false,
            //                 success: function (response) {
            //                     console.log(response);
            //                 }
            //             });
            //     });
            // });

            $(document).ready(function(){
                
                $("#experiencesadd").click(function () {
                    $('#insertColumn').append('<div class="d-flex" id="exp"><input type="text" class="form-control mb-1" name="experience[]"><button class="btn btn-sm  btn-outline-danger ms-2" id="DeleteRow" type="button" style="height: 38px;">-</button></div>');
                });
                $(document).on("click", "#DeleteRow", function () {
                    $(this).parents("#exp").remove();
                })
            });
            loadmoredata();
            $(document).on('click','.loadMore',function(){
                loadmoredata();
            });
            function loadmoredata()
            {
                offset=$('.loadmore').data('offset');
                $.ajax({
                    "url": "{{route('getdata')}}",
                    "type": "GET",
                    "data":{'filter':'', 'length': '3', 'start': offset},
                    success:function(response) {
                        // console.log(response.data.user)
                        if(response.status==true)
                        {
                            $('.loadmore').data('offset', (offset+3));
                            $.each(response.data.user,function(index,element){
                                html='<tr><td>'+(index+1)+'</td><td>'+element.name+'</td><td>'+element.hobby+'</td><td>'+element.email+'</td><td><img src="http://127.0.0.1:8000/get-image?path='+element.image+'" width="50px" height="50px"></td><td> <a href="#" class="" onClick="editdata('+element.id+')">Edit</a> <span class="mx-2">|</span><a href="#" class="" onClick="deletedata('+element.id+')">Delete</a></td></tr>';
                                $('#userdata').append(html);
                            });
                        }
                    }
                })
            }

            function deletedata(id)
            {
                $.ajax({
                    "url": "{{route('delete')}}",
                    "data": {'id': id},
                    "type": "GET",
                    success:function(response){
                        console.log(response.status);

                    }
                })
            }
            
        </script>
    </body>
</html>