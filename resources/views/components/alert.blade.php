@if(session('message'))
    <div class="container">
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="alert alert-success">
                    {!! session('message')[1] !!}
                </div>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
@endif
