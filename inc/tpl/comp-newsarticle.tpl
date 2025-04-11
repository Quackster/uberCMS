
<div class="habblet-container ">		
<div class="cbb clearfix notitle "> 
	
							
	<div id="article-wrapper"> 
	
		<h2>%news_article_title%</h2> 
		
		<div class="article-meta">
		<?php if ($news_article_id > 0) { ?>
			%news_article_date%
			%news_category%
		<?php } ?> 
		</div> 
		
		<?php if (strlen(trim($news_article_summary)) > 0) { ?>		
		<p class="summary">
		
			%news_article_summary%
		
		</p> 
		<?php } ?>
		
		<div class="article-body"> 
		
			%news_article_body%
		
		</div>
		
		<?php if ($news_article_id > 0) { ?>
		<script type="text/javascript" language="Javascript"> 
			document.observe("dom:loaded", function() {
				$$('.article-images a').each(function(a) {
					Event.observe(a, 'click', function(e) {
						Event.stop(e);
						Overlay.lightbox(a.href, "Image is loading");
					});
				});
				
				$$('a.article-%news_article_id%').each(function(a) {
					a.replace(a.innerHTML);
				});
			});
		</script> 
		<?php } ?>

	</div>	
	
</div>
</div> 
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 	
