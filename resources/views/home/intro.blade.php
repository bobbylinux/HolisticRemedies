<div class="row">
    <div class="col-lg-12">
        @if (App::getLocale() == 'it')
            <img class="img-responsive hidden-sm hidden-xs" src="{!!url('/img/intro.png')!!}">
            <img class="img-responsive hidden-md hidden-xs hidden-lg" src="{!!url('/img/intro-sm.png')!!}">
            <img class="img-responsive hidden-sm hidden-md hidden-lg" src="{!!url('/img/intro-xs.png')!!}">
        @elseif (App::getLocale() == 'en')
            <img class="img-responsive hidden-sm hidden-xs" src="{!!url('/img/intro-en.png')!!}">
            <img class="img-responsive hidden-md hidden-xs hidden-lg" src="{!!url('/img/intro-sm-en.png')!!}">
            <img class="img-responsive hidden-sm hidden-md hidden-lg" src="{!!url('/img/intro-xs-en.png')!!}">
        @endif
    </div>
</div>
@if (App::getLocale() == 'it')
<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default" id="panel-newsletter">
            <div class="panel-body">
                <a href="#about" data-toggle="modal" data-target="#myModal"><i class="fa fa-facebook"></i> ISCRIVITI ALLA NOSTRA NEWSLETTER</a>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!! Lang::choice('messages.titolo_newsletter',0) !!}
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default">{!! Lang::choice('messages.pulsante_iscriviti',0) !!}</button>
            </div>
        </div>
    </div>
</div>