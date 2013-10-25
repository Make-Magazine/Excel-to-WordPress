Excel to WordPress Script
=========================

This script will take a Call for Makers Excel document, and turn it into WordPress pages. These are the supported columns for the script. They should be named exactly.

1. ProjectName
2. ProjectDescription
3. WebURL
4. URL
5. Category
6. FirstName
7. LastName
8. ORG
9. Twitter
10. Email

This script will take the project name, and set it as the title of the page. The rest of the data is added to a media object of HTML that has the following structure:

	<div class="the-maker">
		<div class="media">
			<a class="pull-left alignleft" href="__WebURL__">
				<img class="media-object" style="max-width:200px" src="__URL__">
	 		</a>
			<div class="media-body">
				<p>__ProjectDescription__</p>
				<div class="maker">';
					<h3>Maker: __FistName LastName__</h3>
	 				<h4>__ORG__</h4>
					<div class="social">';
						<a class="btn button twitter" href="http://twitter.com/__Twitter__">@__Twitter__</a>
	 					<a class="btn button website" href="__WebURL__"><i class="icon-home"></i> Website</a>
	 					<a class="btn button website" href="mailto:__Email__"><i class="icon-envelope"></i> Email</a>
					</div><!-- .social -->
				</div><!-- .maker -->
			</div><!-- .media-body -->
		</div><!-- .media -->
	</div><!-- .the-maker -->