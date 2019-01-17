<?php
if(!empty($article_list)) { ?>
<section id="recent-news-articles" class="recent-news-articles">
<div class="container">
<h3 class="section-title">RECENT NEWS ARTICLES</h3>
<span class="green-border"></span>
<p class="recent-news-desc">Fresh job related content posted each day</p>
<div class="row blogs row-eq-height">
<?php
$i=0;
foreach($article_list as $val) {
$i++;
if($i > 3)
{
	break;
} ?>
<div class="col-md-4">
	<div id="article-div1" class="article-div">
		<div id="article-top-1" class="article-top">
			<ul class="clearfix">
				<li id="article-top-li-left-1" class="article-top-li pull-left">
				<i class="glyphicon glyphicon-calendar"></i>
				<?php echo $val->insta_article_created_on; ?>
				</li>
				<li id="article-top-li-right-1" class="article-top-li pull-right">
				<!-- <i class="fa fa-commenting-o"></i>
				// 13 Comments-->
				</li>
			</ul>
		</div>
		<h3 class="article-div-title article-div-border"><?php echo $val->insta_article_title; ?></h3>
		<span class="green-border"></span>
			<p id="article-div-desc-1" class="article-div-desc">
			<?php if (strlen($val->insta_article_description) > 200) { echo strip_tags(substr($val->insta_article_description ,0, 200)).'..';  }else{ echo strip_tags($val->insta_article_description ); }  ?>
			</p>
			<div class="text-center">
			<?php if (strlen($val->insta_article_description) > 200) { ?>
			<a href="<?php echo base_url().'blog/'.$val->insta_article_id; ?>" id="article-div-link-1" class="article-div-link trans" title="Read More">READ MORE</a>
			<?php } ?>
			</div>
	</div>
</div>
<?php } ?>
<!-- <a href="javascript:void(0)" id="recent-news-articles-link" class="recent-news-articles-link trans">View More</a> -->
</div>
</section>
<?php } ?>