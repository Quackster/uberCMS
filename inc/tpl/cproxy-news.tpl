<div class="habblet-container ">		
	
	<div id="news-habblet-container">
	
		<div class="title">
		
			<div class="habblet-close"></div>
			
			<div>The shit you don't even wanna know!</div>
			
		</div>
		
		<div class="content-container">
		
			<div id="news-articles">
			
				<ul id="news-articlelist" class="articlelist" style="display: none">
				<?php
				
				$getNews = dbquery("SELECT * FROM site_news ORDER BY id DESC LIMIT 10");
				
				$oddEven = "odd";
				
				while ($n = mysql_fetch_assoc($getNews))
				{
					if ($oddEven == "odd")
					{
						$oddEven = "even";
					}
					else
					{
						$oddEven = "odd";
					}
			
					echo '<li class="' . $oddEven . '">
					
					  <div class="news-title">' . clean($n['title']) . '</div>
					  <div class="news-summary">' . clean($n['snippet'], true, true) . '</div>
					  <div class="newsitem-date">' . clean($n['datestr']) . '</div>
					  
					  <div class="clearfix">
					  
						<a href="' . WWW . '/articles/' . $n['id'] . '-' . $n['seo_link'] . '" target="_blank" class="article-toggle">Read on site</a>
						
					  </div>
					  
					</li>';
				}
					
				?>
				</ul>
				
			</div>
			
		</div>
		
		<div class="news-footer"></div>
	
	</div>

	<script type="text/javascript">    
		L10N.put("news.promo.readmore", "Read more").put("news.promo.close", "Close article");
		News.init(false);
	</script>

</div>

<!-- dependencies
<link rel="stylesheet" href="%static_url%/web-gallery/v2/styles/news.css" type="text/css" />
<script src="%static_url%/web-gallery/static/js/news.js" type="text/javascript"></script>
-->