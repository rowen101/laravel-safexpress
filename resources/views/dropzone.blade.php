<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Safexpress</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.5.1/dropzone.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
</head>
<body>
<div class="container-fluid">

    <br />
    <h3 align="center" style="color: #4dc0b5">{{ $data->foldername }}</h3>
    <br />
    <a href="{{ url('admin/gallery') }}">
        <button class="btn btn-primary"><i class="fas fa-arrow-left"></i>&nbsp;back</button>
    </a>

    <div class="panel panel-default">
        <div class="panel-body">
            <form id="dropzoneForm" class="dropzone" action="{{ route('dropzone.upload') }}">
                @csrf
                <input type="hidden" name="parent_id" value="{{$data->id}}"/>
                <input type="hidden" name="foldername" value="{{$data->foldername}}"/>
            </form>
            <div align="center">
                <button type="button" class="btn btn-success" id="submit-all">Upload</button>
            </div>
        </div>
    </div>
    <br />
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Uploaded Image</h3>
        </div>
        <div class="panel-body" id="uploaded_image">

        </div>
    </div>
</div>
</body>
</html>

<script type="text/javascript">

    Dropzone.options.dropzoneForm = {
        autoProcessQueue : false,
        acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",

        init:function(){
            var submitButton = document.querySelector("#submit-all");
            myDropzone = this;

            submitButton.addEventListener('click', function(){
                myDropzone.processQueue();
            });

            this.on("complete", function(){
                if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
                {
                    var _this = this;
                    _this.removeAllFiles();
                }
                load_images();
            });

        }

    };

    load_images();

    function load_images()
    {
        $.ajax({
            url:"{{ route('dropzone.fetch') }}",
            success:function(data)
            {
                $('#uploaded_image').html(data);
            }
        })
    }

    $(document).on('click', '.remove_image', function(){
        var name = $(this).attr('id');
        $.ajax({
            url:"{{ route('dropzone.delete') }}",
            data:{name : name},
            success:function(data){
                load_images();
            }
        })
    });

</script>
