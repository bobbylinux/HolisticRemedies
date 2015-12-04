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
                <p>{!! Lang::choice('messages.newsletter',0) !!}</p>
                <a href="{!! url('sendletter/iscrizione.php') !!}" target="_blank"><i class="fa fa-3x fa-envelope"></i>  </a>
            </div>
        </div>
    </div>
</div>
@endif