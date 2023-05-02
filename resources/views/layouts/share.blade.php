<div class="modal fade" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Share</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body form-inline">
                @foreach($socialShare as $key => $value)
                    <div class="social-links">
                        <a href="{{$value}}" onclick="window.open('{{$value}}','newwindow','width=500,height=400,top=200,left=475'); return false;"
                           class="btn btn-primary social-link ml-2" data-share="{{$key}}">
                            <i class="fab fa-{{$key}}"></i>
                            <span class="button__label">{{ucfirst($key)}}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
