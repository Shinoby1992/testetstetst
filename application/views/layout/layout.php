<!DOCTYPE html>
<html lang="en">
    <head>
        <title><?php echo $this->settings->info->site_name ?></title>         
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap -->
        <link href="<?php echo base_url();?>bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

         <!-- Styles -->
        <link href="<?php echo base_url();?>styles/main.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>styles/dashboard.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url();?>styles/responsive.css" rel="stylesheet" type="text/css">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,500,600,700' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />

        <!-- SCRIPTS -->
        <script type="text/javascript">
        var global_base_url = "<?php echo site_url('/') ?>";
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
        <script src="<?php echo base_url();?>bootstrap/js/bootstrap.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        

        <script type="text/javascript">
            $(document).ready(function() {
                $( document ).tooltip();
            });
        </script>

        <!-- CODE INCLUDES -->
        <?php echo $cssincludes ?> 
    </head>
    <body>

    <nav class="navbar navbar-header2 navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo site_url() ?>" title="<?php echo $this->settings->info->site_name ?>"><img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->settings->info->site_logo ?>" width="123" height="32"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
          <?php if($this->user->loggedin) : ?>
            <li><a href="<?php echo site_url("user_settings") ?>"><?php echo $this->user->info->email ?></a></li>
            <li><a href="<?php echo site_url("login/logout/" . $this->security->get_csrf_hash()) ?>"><?php echo lang("ctn_149") ?></a></li>
	        <?php else : ?>
	        <li><a href="<?php echo site_url("login") ?>"><?php echo lang("ctn_150") ?></a></li>
            <li><a href="<?php echo site_url("register") ?>"><?php echo lang("ctn_151") ?></a></li>
	        <?php endif; ?>
          </ul>
          <?php echo form_open(site_url("members/search"), array("class" => "navbar-form navbar-right")); ?>
            <input type="text" class="form-control" name="search" placeholder="<?php echo lang("ctn_152") ?> ...">
          <?php echo form_close() ?>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
        <?php if($this->user->loggedin) : ?>
          <div class="active-project">
          <table><tr><td width="55">
          <img src="<?php echo base_url() ?><?php echo $this->settings->info->upload_path_relative ?>/<?php echo $this->user->info->avatar ?>" class="user_avatar">
          </td><td valign="top"><h5 class="user_name_display"><a href="<?php echo site_url("profile/" . $this->user->info->username) ?>" class="white-link"><?php echo $this->user->info->username ?></a></h5><p class="user_level_display"><?php echo $this->common->getAccessLevel($this->user->info->user_level) ?></p>
          </td>
          </tr>
          </table>
          </div>
        <?php else: ?>
          <div class="active-project">
          <table><tr><td><h5 class="active-project-title"><?php echo lang("ctn_154") ?></h5>
          <p><a href="<?php echo site_url("login") ?>" class="btn btn-success btn-xs"><?php echo lang("ctn_150") ?></a> <a href="<?php echo site_url("register") ?>" class="btn btn-primary btn-xs"><?php echo lang("ctn_151") ?></a></p></td>
          </tr>
          </table>
          </div>
        <?php endif; ?>


        <?php if(isset($sidebar)) : ?>
          <?php echo $sidebar ?>
        <?php endif; ?>
          <ul class="newnav nav nav-sidebar">
            <li class="<?php if(isset($activeLink['home']['general'])) echo "active" ?>"><a href="<?php echo site_url() ?>"><span class="glyphicon glyphicon-home"></span> <?php echo lang("ctn_154") ?> <span class="sr-only">(current)</span></a></li>
            <li class="<?php if(isset($activeLink['members']['general'])) echo "active" ?>"><a href="<?php echo site_url("members") ?>"><span class="glyphicon glyphicon-user"></span> <?php echo lang("ctn_155") ?></a></li>
            <li class="<?php if(isset($activeLink['settings']['general'])) echo "active" ?>"><a href="<?php echo site_url("user_settings") ?>"><span class="glyphicon glyphicon-cog"></span> <?php echo lang("ctn_156") ?></a></li>
            <?php if($this->user->loggedin && $this->user->info->user_level == 4) : ?>
              <li id="admin_sb">
                <a data-toggle="collapse" data-parent="#admin_sb" href="#admin_sb_c" class="collapsed bolded <?php if(isset($activeLink['admin'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-home sidebar-icon"></span> <?php echo lang("ctn_157") ?>
                  <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
                </a>
                <div id="admin_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['admin'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                    <li class="<?php if(isset($activeLink['admin']['settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/settings") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_158") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['social_settings'])) echo "active" ?>"><a href="<?php echo site_url("admin/social_settings") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_159") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['members'])) echo "active" ?>"><a href="<?php echo site_url("admin/members") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_160") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['user_groups'])) echo "active" ?>"><a href="<?php echo site_url("admin/user_groups") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_161") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['ipblock'])) echo "active" ?>"><a href="<?php echo site_url("admin/ipblock") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_162") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['email_templates'])) echo "active" ?>"><a href="<?php echo site_url("admin/email_templates") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_163") ?></a></li>
                    <li class="<?php if(isset($activeLink['admin']['email_members'])) echo "active" ?>"><a href="<?php echo site_url("admin/email_members") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_164") ?></a></li>
                  </ul>
                </div>
              </li>
            <?php endif; ?>
          </ul>
          <ul class="newnav nav nav-sidebar">
          <li class="<?php if(isset($activeLink['test']['general'])) echo "active" ?>"><a href="<?php echo site_url("test") ?>"><span class="glyphicon glyphicon-heart"></span> <?php echo lang("ctn_165") ?></a></li>
          <li id="restricted_sb">
                <a data-toggle="collapse" data-parent="#restricted_sb" href="#restricted_sb_c" class="collapsed bolded <?php if(isset($activeLink['restricted'])) echo "active" ?>" >
                  <span class="glyphicon glyphicon-lock sidebar-icon"></span> <?php echo lang("ctn_166") ?>
                  <span class="plus-sidebar"><span class="glyphicon glyphicon-chevron-down"></span></span>
                </a>
                <div id="restricted_sb_c" class="panel-collapse collapse sidebar-links-inner <?php if(isset($activeLink['restricted'])) echo "in" ?>">
                  <ul class="inner-sidebar-links">
                    <li class="<?php if(isset($activeLink['restricted']['general'])) echo "active" ?>"><a href="<?php echo site_url("test/restricted_admin") ?>"><span class="glyphicon glyphicon-wrench"></span> <?php echo lang("ctn_167") ?> <span class="sr-only">(current)</span></a></li>
                    <li class="<?php if(isset($activeLink['restricted']['groups'])) echo "active" ?>"><a href="<?php echo site_url("test/restricted_group") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_168") ?></a></li>
                    <li class="<?php if(isset($activeLink['restricted']['users'])) echo "active" ?>"><a href="<?php echo site_url("test/restricted_user") ?>"><span class="glyphicon glyphicon-arrow-right admin-sb-link"></span> <?php echo lang("ctn_169") ?></a></li>
                  </ul>
                </div>
              </li>
          </ul>
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <div id="responsive-menu-links">
          <select name='link' OnChange="window.location.href=$(this).val();" class="form-control">
          <option value='<?php echo site_url() ?>'><?php echo lang("ctn_154") ?></option>
          <option value='<?php echo site_url("members") ?>'><?php echo lang("ctn_155") ?></option>
          <option value='<?php echo site_url("user_settings") ?>'><?php echo lang("ctn_156") ?></option>
          <?php if($this->user->loggedin && $this->user->info->user_level == 4) : ?>
            <option value='<?php echo site_url("admin/settings") ?>'><?php echo lang("ctn_158") ?></option>
            <option value='<?php echo site_url("admin/social_settings") ?>'><?php echo lang("ctn_159") ?></option>
            <option value='<?php echo site_url("admin/members") ?>'><?php echo lang("ctn_160") ?></option>
            <option value='<?php echo site_url("admin/user_groups") ?>'><?php echo lang("ctn_161") ?></option>
            <option value='<?php echo site_url("admin/ipblock") ?>'><?php echo lang("ctn_162") ?></option>
            <option value='<?php echo site_url("admin/email_templates") ?>'><?php echo lang("ctn_163") ?></option>
            <option value='<?php echo site_url("admin/email_members") ?>'><?php echo lang("ctn_164") ?></option>
          <?php endif; ?>
          <option value='<?php echo site_url("test") ?>'><?php echo lang("ctn_165") ?></option>
          <option value='<?php echo site_url("test/restricted_admin") ?>'><?php echo lang("ctn_167") ?></option>
          <option value='<?php echo site_url("test/restricted_group") ?>'><?php echo lang("ctn_168") ?></option>
          <option value='<?php echo site_url("test/restricted_user") ?>'><?php echo lang("ctn_169") ?></option>
          </select> 
        </div>
        <?php $gl = $this->session->flashdata('globalmsg'); ?>
        <?php if(!empty($gl)) :?>
                    <div class="row">
                        <div class="col-md-12">
                                <div class="alert alert-success"><b><span class="glyphicon glyphicon-ok"></span></b> <?php echo $this->session->flashdata('globalmsg') ?></div>
                        </div>
                    </div>
        <?php endif; ?>

        <?php echo $content ?>

        <hr>
        <p class="align-center small-text"><?php echo lang("ctn_170") ?> <a href="http://www.patchesoft.com/">Patchesoft</a><br /> <?php echo $this->settings->info->site_name ?> V<?php echo $this->settings->version ?> - <a href="<?php echo site_url("home/change_language") ?>"><?php echo lang("ctn_171") ?></a></p>

          </div>
      </div>
    </div>


    </body>
</html>