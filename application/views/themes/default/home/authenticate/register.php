    <div class="form-group" id="register_typepage">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-user" aria-hidden="true"></i></span>
            <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('regusernametext','authentication','solo');?>" id="users_uname" class="form-control validate username">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-envelope" aria-hidden="true"></i></span>
            <input type="text" placeholder="<?php echo $this->ts_functions->getlanguage('regemailtext','authentication','solo');?>" id="users_email" class="form-control validate email">
        </div>
    </div>
    <div class="form-group">
        <div class="input-group">
            <span class="input-group-addon" id="basic-addon1"><i class="fa fa-lock" aria-hidden="true"></i></span>
            <input type="password" placeholder="<?php echo $this->ts_functions->getlanguage('logpwdtext','authentication','solo');?>" id="users_pwd" class="form-control validate pwd">
        </div>
    </div>
    <div class="ts_login_btn_field">
        <a onclick="checkformvalidation();" class="ts_btn pull-right" ><?php echo $this->ts_functions->getlanguage('signuptext','commontext','solo');?>  <i class="fa fa-spinner fa-spin ts_submit_wait hideme" aria-hidden="true"></i></a>

    </div>

</div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class="ts_get_link ts_toppadder20">
       <?php echo $this->ts_functions->getlanguage('regbottomtext','authentication','solo');?><a href="<?php echo $basepath; ?>authenticate/login"> <?php echo $this->ts_functions->getlanguage('regbottomhreftext','authentication','solo');?></a>
    </div>
