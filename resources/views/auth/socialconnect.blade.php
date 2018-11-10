<script>
    window.fbAsyncInit = function() {
    FB.init({
      appId      : "{{ env('FACEBOOK_APP_ID') }}",
      cookie     : true,
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();   
    };

    (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>

<br>

<div class="card card-default card-black">
	<div class="card-body">
		<div class="text-center" style="width: 250px; margin: 0 auto;">
		    <a class="btn btn-block btn-social btn-facebook" href="/auth/facebook">
		      <span class="fa fa-facebook-f"></span>
		      Se connecter avec Facebook
		    </a>
		</div>
		<br>
		<div class="text-center" style="width: 250px; margin: 0 auto;">
		    <a class="btn btn-block btn-social btn-google" href="/auth/google">
		      <span class="fa fa-google"></span>
		      Se connecter avec Google
		    </a>
		</div>
	</div>
</div>
<div class="clearfix"></div>