<div class="row">
    <div class="col-lg-12">
        @if (App::getLocale() == 'it')
        <img class="img-responsive hidden-sm hidden-xs" src="{!!url('/img/intro.png')!!}">
        <img class="img-responsive hidden-md hidden-xs hidden-lg" src="{!!url('/img/intro-sm.png')!!}">
        <img class="img-responsive hidden-sm hidden-md hidden-lg img-responsive-sm" src="{!!url('/img/intro-xs.png')!!}">
        @elseif (App::getLocale() == 'en')
        <img class="img-responsive hidden-sm hidden-xs" src="{!!url('/img/intro-en.png')!!}">
        <img class="img-responsive hidden-md hidden-xs hidden-lg" src="{!!url('/img/intro-sm-en.png')!!}">
        <img class="img-responsive hidden-sm hidden-md hidden-lg img-responsive-sm" src="{!!url('/img/intro-xs-en.png')!!}">
        @endif
    </div>
</div>
@if (App::getLocale() == 'it')
<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default" id="panel-newsletter">
            <div class="panel-body">
                <a href="#about" data-toggle="modal" data-target="#modal-news"><i class="fa fa-envelope"></i> {!! Lang::choice('messages.newsletter',0) !!} </a>
            </div>
        </div>
    </div>
</div>
@endif
<!-- Modal -->
<div class="modal fade" id="modal-news" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {!! Lang::choice('messages.titolo_newsletter',0) !!}
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome e Cognome</label>
                        <input type="text" class="form-control" id="surname-news" placeholder="Nome e Cognome">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Email</label>
                        <input type="text" class="form-control" id="email-news" placeholder="Email">
                    </div>                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default">{!! Lang::choice('messages.pulsante_iscriviti',0) !!}</button>
            </div>
        </div>
    </div>
</div>