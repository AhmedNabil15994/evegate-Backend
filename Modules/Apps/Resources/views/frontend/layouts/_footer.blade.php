s <!--=====================================
                    FOOTER PART PART
=======================================-->
<footer class="footer-part">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 col-md-6 col-lg-3">
				<div class="footer-content">
					<h3>@lang("apps::frontend.layout.footer.contact_us")</h3>
					<ul class="footer-address">
						{{-- <li>
							<i class="fas fa-map-marker-alt"></i>
							<p>1420 West Jalkuri Fatullah, <span>Narayanganj, BD</span></p>
						</li> --}}
						<li>
							<i class="fas fa-envelope"></i>
							<p>{{setting("contact_us", "email")}}</p>
						</li>
						<li>
							<i class="fas fa-phone-alt"></i>
							<p>{{setting("contact_us", "whatsapp")}}</p>
						</li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">
				<div class="footer-content">
					<h3>@lang("apps::frontend.layout.footer.quick_links")</h3>
					<ul class="footer-widget">
						@foreach ($pages as $page)
							<li><a href="{{route('frontend.pages.index', $page->translateOrDefault(locale())->slug)}}">{{$page->translateOrDefault(locale())->title}}</a></li>
						@endforeach
						
					
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">	
				<div class="footer-content">
					<h3>@lang("apps::frontend.layout.footer.information")</h3>
					<ul class="footer-widget">
						<li><a href="{{route('frontend.contact_us')}}">@lang("apps::frontend.layout.aside.contact_us")</a></li>
					</ul>
				</div>
			</div>
			<div class="col-sm-6 col-md-6 col-lg-3">
				<div class="footer-info">
					<a href="#"><img src="/frontend/images/logo.png" alt="logo"></a>
					<ul class="footer-count">
						<li>
							<h5>{{number_format($usersCount)}}</h5>
							<p>@lang("apps::frontend.layout.footer.register_users")</p>
						</li>
						<li>
							<h5>{{number_format($adsCount)}}</h5>
							<p>@lang("apps::frontend.layout.footer.community_ads")</p>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="footer-card-content">
					<div class="footer-payment">
						<a href="#"><img src="/frontend/images/pay-card/01.jpg" alt="01"></a>
						<a href="#"><img src="/frontend/images/pay-card/02.jpg" alt="02"></a>
						<a href="#"><img src="/frontend/images/pay-card/03.jpg" alt="03"></a>
						<a href="#"><img src="/frontend/images/pay-card/04.jpg" alt="04"></a>
					</div>
					<div class="footer-option">
						<button type="button" data-toggle="modal" data-target="#language"><i class="fas fa-globe"></i>{{LaravelLocalization::getCurrentLocaleNative()}}</button>
					
					</div>
					<div class="footer-app">
						<a href="{{ setting('other','andriod' ) ?? '#' }}"><img src="/frontend/images/play-store.png" alt="play-store"></a>
						<a href="{{ setting('other','ios' ) ?? '#' }}"><img src="/frontend/images/app-store.png" alt="app-store"></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="footer-end">
		<div class="container">
			<div class="footer-end-content">
				<p>@lang("apps::frontend.layout.footer.copyrights") &copy; {{date("Y")}} - @lang("apps::frontend.layout.footer.developed_by") <a href="#">Tocaan</a></p>
				<ul class="footer-social">
					<li><a href="{{setting('social_media', 'facebook')}}"><i class="fab fa-facebook-f"></i></a></li>
					<li><a href="{{setting('social_media', 'twitter')}}"><i class="fab fa-twitter"></i></a></li>
					<li><a href="{{setting('social_media', 'linkedin')}}"><i class="fab fa-linkedin-in"></i></a></li>
					<li><a href="{{setting('social_media', 'youtube')}}"><i class="fab fa-youtube"></i></a></li>
					<li><a href="{{setting('social_media', 'snapchat')}}"><i class="fab fa-snapchat"></i></a></li>
				
				</ul>
			</div>
		</div>
	</div>
</footer>
<!--=====================================
			FOOTER PART END
=======================================-->


<!--=====================================
			LANGUAGE MODAL PART END
=======================================-->
<div class="modal fade" id="language">
	<div class="modal-dialog modal-dialog-centered">
		<div class="modal-content">
			<div class="modal-header">
				<h4>@lang("apps::frontend.layout.footer.choose_langue")</h4>
				<button class="fas fa-times" data-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				@foreach (config('laravellocalization.supportedLocales', [] ) as $localeCode => $properties)
				
			   <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" 
			   			class="modal-link {{ LaravelLocalization::getCurrentLocaleNative() == $properties['native'] ? 'active' :'' }}">
					{{ $properties['native'] }}
			   </a>
			  @endforeach
				
				
			</div>
		</div>
	</div>
</div>
<!--=====================================
			LANGUAGE MODAL PART END
=======================================-->
