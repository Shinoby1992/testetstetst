<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_189") ?></div>
    <div class="db-header-extra"> 
</div>
</div>

<ol class="breadcrumb">
  <li><a href="<?php echo site_url() ?>"><?php echo lang("ctn_2") ?></a></li>
  <li class="active"><?php echo lang("ctn_189") ?></li>
</ol>

<p><?php echo lang("ctn_190") ?></p>

<hr>

	<div class="align-center">
	  <?php echo $this->pagination->create_links(); ?>
	</div>

<table class="table table-bordered">
<tr class="table-header"><td><?php echo lang("ctn_191") ?>
<?php if($col === 1) : ?>
	<?php if($sort == 1) : ?>
	<a href="<?php echo site_url("members/index/1/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-up icon-nolink"></span></a>
	<?php else : ?>
	<a href="<?php echo site_url("members/index/1/1/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink"></span></a>
	<?php endif; ?>
<?php else : ?>
	<a href="<?php echo site_url("members/index/1/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink faded"></span></a>
<?php endif; ?>
</td><td><?php echo lang("ctn_192") ?>
<?php if($col === 2) : ?>
	<?php if($sort == 1) : ?>
	<a href="<?php echo site_url("members/index/2/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-up icon-nolink"></span></a>
	<?php else : ?>
	<a href="<?php echo site_url("members/index/2/1/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink"></span></a>
	<?php endif; ?>
<?php else : ?>
	<a href="<?php echo site_url("members/index/2/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink faded"></span></a>
<?php endif; ?>
</td><td><?php echo lang("ctn_193") ?>
<?php if($col === 3) : ?>
	<?php if($sort == 1) : ?>
	<a href="<?php echo site_url("members/index/3/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-up icon-nolink"></span></a>
	<?php else : ?>
	<a href="<?php echo site_url("members/index/3/1/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink"></span></a>
	<?php endif; ?>
<?php else : ?>
	<a href="<?php echo site_url("members/index/3/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink faded"></span></a>
<?php endif; ?>
</td><td><?php echo lang("ctn_194") ?>
<?php if($col === 4) : ?>
	<?php if($sort == 1) : ?>
	<a href="<?php echo site_url("members/index/4/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-up icon-nolink"></span></a>
	<?php else : ?>
	<a href="<?php echo site_url("members/index/4/1/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink"></span></a>
	<?php endif; ?>
<?php else : ?>
	<a href="<?php echo site_url("members/index/4/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink faded"></span></a>
<?php endif; ?>
</td><td><?php echo lang("ctn_195") ?>
<?php if($col === 5) : ?>
	<?php if($sort == 1) : ?>
	<a href="<?php echo site_url("members/index/5/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-up icon-nolink"></span></a>
	<?php else : ?>
	<a href="<?php echo site_url("members/index/5/1/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink"></span></a>
	<?php endif; ?>
<?php else : ?>
	<a href="<?php echo site_url("members/index/5/0/" . $page) ?>"><span class="glyphicon glyphicon-chevron-down icon-nolink faded"></span></a>
<?php endif; ?>
</td></tr>

<?php foreach($members->result() as $r) : ?>
	<?php if($r->oauth_provider == "google") {
		$provider = "Google";
	} elseif($r->oauth_provider == "twitter") {
		$provider = "Twitter";
	} elseif($r->oauth_provider == "facebook") {
		$provider = "Facebook";
	} else {
		$provider =  lang("ctn_196");
	}
	?>
<tr><td><a href="<?php echo site_url("profile/" . $r->username) ?>"><?php echo $r->username ?></a></td><td><?php echo $r->first_name . " " . $r->last_name ?></td><td><?php echo $this->common->getAccessLevel($r->user_level) ?></td><td><?php echo date($this->settings->info->date_format, $r->joined) ?></td><td><?php echo $provider ?></td></tr>
<?php endforeach; ?>

</table>

	<div class="align-center">
	  <?php echo $this->pagination->create_links(); ?>
	</div>

</div>