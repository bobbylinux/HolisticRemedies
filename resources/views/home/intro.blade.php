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
<div class="row">
    <div class="col-lg-6 col-lg-offset-3">
        <div class="panel panel-default" id="panel-newsletter">
            <div class="panel-body">
                <form class="form-horizontal">
                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="inputEmail3" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="inputPassword3" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox"> Remember me
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Sign in</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>