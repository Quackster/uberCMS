<div class="habblet-container ">		
<div class="cbb clearfix orange "> 

<h2 class="title">%site_name% on Twitter
</h2> 

<div class="box-content"> 
<script src="http://widgets.twimg.com/j/2/widget.js"></script>
<script>
new TWTR.Widget({
  version: 2,
  type: 'profile',
  rpp: 3,
  interval: 6000,
  width: 275,
  height: 200,
  theme: {
    shell: {
      background: '#ffffff',
      color: '#000000'
    },
    tweets: {
      background: '#edf4ff',
      color: '#332d33',
      links: '#0788eb'
    }
  },
  features: {
    scrollbar: false,
    loop: false,
    live: true,
    hashtags: true,
    timestamp: true,
    avatars: true,
    behavior: 'all'
  }
}).render().setUser('uberHotel').start();
</script>
</div> 

</div> 
</div> 
<script type="text/javascript">if (!$(document.body).hasClassName('process-template')) { Rounder.init(); }</script> 