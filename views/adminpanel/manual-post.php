<div class="main" style="padding-top:20px;" onLoad="return set_height(this)">
<?php if((update_checker() == 1) and empty($_SESSION['latters_update'])){ 

        ?>
    <div class="update-notif" style="border:1px #e2e2e3 solid;padding: 20px;background: #edfaec;border-radius: 5px;margin-bottom: 10px;color:#666">
        Good News !, Some Update Was Found. Are you want to update this script now ?
         <span style="float: right;margin-top: -10px;">
          <button onClick="script_update()" style="cursor:pointer;padding: 10px;background: #24cd77;border:1px #24cd77 solid;border-radius: 5px;color:#fff"> Update Now</button> 
        <button onClick="update_latter()" style="cursor:pointer;padding: 10px;background: #f1f1f1;border:1px #e2e2e3 solid;border-radius: 5px;color:#666"> Update Latter</button>
    </span>
    </div>
<?php } ?>
<div class="box mid1" style="padding:10px;width: 30%;margin-left:36%" >

	<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Market Url / Package Names <span  id="play-load" ></span></h4>
<input autocomplete="off" id="market-id" value="<?php if(!empty(GET('id'))) echo GET('id'); ?>" type="text" name="market_url" onKeyup="return word_check(this)" onchange="return typehead(this)" placeholder="Playstore Url ...." style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width:85%"><button type="button" id="klk-s" style="padding:6px;background: #24cd77; color:#fff;border:1px #24cd77 solid;width:11%" onClick="cek_artikel(this)"><i class="fa fa-paper-plane"></i></button>
<div id="typehead" style="display: none;height:200px;overflow-y:scroll;border: 1px #e2e2e3 solid;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);padding:10px; "></div>
<br>
<br>
<span id="failed" style="display: none;">
	<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;margin-bottom:10px;" class="alert alert-danger" role="alert">
    <strong>Failed </strong> Get Data
    </div>
</span>
<span id="failed1" style="display: none;">
	<div style="background:#24cd77;color:#fff;padding:10px;border-radius:5px;margin-bottom:10px;" class="alert alert-danger" role="alert">
    <strong>Sorry </strong> The Item Is already Exist
    </div>
</span>
<span id="alert" style="font-size: 10px;color:#ccc">* The system just wants to make sure that the items you are making are really relevant, ie they are in the store and not double with the items you have made</span>
<br>
</div>
<form method="POST" action="" enctype="multipart/form-data" onSubmit="return post_manual_data(this)">
<div class="after-load" style="display: none;">
<div class="left">
	<div class="box" style="padding: 10px;">
<table width="100%">
<tr>
	<td valign="top" style="width: 100px"><img id="hide-icon" src="" style="width:75px;height:75px;border-radius: 10px;border:1px #ccc solid;">
	</td>
	<td valign="top"><h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 10px;">Heading</h4>
<input autocomplete="off" type="text" id="hide-title" onKeyup="return write_title(this)" placeholder="Input post title ..." name="title" style="width: 97.5%;padding:10px;border:1px #e2e2e3 solid;color:#666">
<input autocomplete="off" type="text" id="uniq-id" style="display: none;">
</td>
</tr>
</table>		

<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 10px;">Short Description <small style="font-size: 10px;" id="length-hit"></small></h4>
<textarea id="hide-desc" onKeyup="return write_short_desc(this)" style="padding:6px;border:1px #e2e2e3 solid;width: 98.5%;height: 150px;color:#666" placeholder="short description ..."  name="short_desc"></textarea>

<div style="margin-top:10px;border:1px #e2e2e3 solid;border-radius: 5px;padding: 10px;">
<h4><a href="#" id="title-desc"></a></h4>	
<p id="url-desc" style="color: #24cd77;font-size:12px;"></p>
<p id="desc-desc" style="font-size: 12px;"></p>
</div>
</div>

<div class="box" style="padding: 10px;">
<h4 style="color:#666;font-size: 17px;margin-bottom: 10px;margin-top: 10px;">Featured Description</h4>
<textarea id="long-description" style="padding:10px;border:1px #e2e2e3 solid;width: 97%;height: 300px;" class="textarea1 form-control" name="description"></textarea>
</div>

<div class="box" style="padding: 10px;">
<h4 style="color:#666;font-size: 17px;margin-bottom: 10px;margin-top: 10px;">What's New</h4>
<textarea  id="hide-whatsnew" style="padding:10px;border:1px #e2e2e3 solid;width: 97%;height: 200px;" class="textarea1 form-control" name="what_is_new"></textarea>
</div>

<div class="box bos-xx" style="padding: 10px;display: none;">

<h4 style="color:#666;font-size: 17px;margin-bottom: 10px;margin-top: 10px;">Screenshoot</h4>

<div style="overflow-x: scroll;">
<div id="show-ss" style="margin-top: 10px;width: 15000px;"></div>
<input autocomplete="off" type="text" id="save-ss" name="screenshots" style="display: none">
</div>
</div>
</div>

<div class="right">
<div class="box" style="padding:10px;" >

	<h4 style="color:#666;font-size: 17px;margin-bottom: 10px;margin-top: 20px;">Market Url / Package Names <span  id="play-load" ></span></h4>
<input autocomplete="off" id="market-id" type="button" class="mid2" name="market_url" onKeyup="return word_check(this)" onchange="return typehead(this)" placeholder="Playstore Url ...." style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width:97%;background: #f5f5f5" readonly="">
<div id="typehead" style="display: none;height:200px;overflow-y:scroll;border: 1px #e2e2e3 solid;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);padding:10px; "></div>
<br>
<br>
<span id="failed" style="display: none;">
	<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;margin-bottom:10px;" class="alert alert-danger" role="alert">
    <strong>Failed </strong> Get Data
    </div>
</span>
<span id="failed1" style="display: none;">
	<div style="background:#24cd77;color:#fff;padding:10px;border-radius:5px;margin-bottom:10px;" class="alert alert-danger" role="alert">
    <strong>Sorry </strong> The Item Is already Exist
    </div>
</span>
<span id="alert" style="font-size: 10px;color:#ccc">* The system just wants to make sure that the items you are making are really relevant, ie they are in the store and not double with the items you have made</span>
<br>
</div>

<div class="box" style="padding:10px;">

<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 10px;">Tags / Keyword</h4>
<span id="alert" style="font-size: 10px;color:#ccc">* Please use (,) for spliting keyword</span>
<textarea type="text" id="hide-key" placeholder="Tulis Tag Terkait" name="keyword" onkeyup="return load_keyword(this)" style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width: 95%;height: 100px"></textarea>
<div class="tag-result" style="padding-top: 10px;display: none;"></div>
</div>



<div class="box" style="padding:10px;">
<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Genre</h4>
<input autocomplete="off" placeholder="Input genre ..." type="text" onClick="load_genre()" readonly name="category" id="cats-1" style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width: 86%"><button id="cats-2" onClick="load_genre()" type="button" style="width:9%;padding:6px;border: 1px #e2e2e3 solid;background: #f1f1f1"><i style="color:#666" class="fa fa-caret-down"></i></button>
<div class="kontainer-genre" style="background: #fff;padding: 5px;border:1px #e2e2e3 solid;box-shadow: 0px 2px 3px rgba(0,0,0,.13) ,1px 2px 2px rgba(0,0,0,.1) , -1px -2px 2px rgba(0,0,0,.05);position: absolute;display: none;overflow-y: scroll;height:200px;">
	<ul>
	<?php 
		$cat = connectDB()->bindQuery("SELECT * FROM category ORDER BY name DESC");
		foreach($cat as $key => $val){
	?>
	<li onClick="fill_genre('<?=$val->name?>')" class="pil-gen" style="list-style-type: none;padding: 7px;cursor: pointer;"><?=$val->name?></li>

<?php } ?>
</ul>
</div>
<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Developer</h4>
<input autocomplete="off" id="developer" type="text" name="developer" placeholder="Deveoper application ..." style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width: 94%">
<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Size Apk</h4>
<input autocomplete="off" id="size" type="text" name="size" placeholder="apk size ..." style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width: 94%">
<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Version</h4>
<input autocomplete="off" id="version" type="text" name="version" placeholder="apk version ..." style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width: 94%">
<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Minimun Requirement</h4>
<input autocomplete="off" id="min-sdk" type="text" name="min_sdk" placeholder="minimum requirement for install ..." style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width: 94%">
</div>

<div class="box" style="padding: 10px;">
<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Youtube Trailer</h4>
<input autocomplete="off" id="yt" type="text" name="promo_video" onKeyup="return yt_embed(this)" placeholder="youtube embed url video ..." style="color:#666;padding: 6px;border:1px #e2e2e3 solid;width: 85.5%"><button style="padding:6px;background: #f5f5f5; color:#666;border:1px #e2e2e3 solid;width:9%;margin-top: 10px;margin-bottom: 10px;"><i class="fa fa-youtube"></i></button>

<span id="yt-embed"></span>
</div>

<input autocomplete="off" type="text" name="action_ready" value="publish" style="display: none;">

<div class="box" style="padding:10px;">
<h4 style="color:#666;font-size: 17px;margin-bottom: 7px;margin-top: 20px;">Date Publish</h4>
<input autocomplete="off" readonly="" onClick="date_pickers()" id="date" type="text" name="date" value="<?=date("Y-m-d")?>" style="width:85%;padding: 6px;border:1px #e2e2e3 solid;" placeholder="Set Schedule "><button style="padding:6px;background: #f5f5f5; color:#666;border:1px #e2e2e3 solid;width:9%;margin-top: 10px;margin-bottom: 10px;"><i class="fa fa-calendar"></i></button>
 
                            <button type="submit" id="waiting" name="manual_post" style="padding:6px;background: #24cd77; color:#fff;border:1px #24cd77 solid;width:50%;margin-top: 10px;margin-bottom: 10px;">Publish</button>
<span id="failed" style="display: none;margin-top: 10px;">
	<div style="background:#f8d7da;color:#666;padding:10px;border-radius:5px;margin-bottom:10px;" class="alert alert-danger" role="alert">
    <strong>Failed </strong> publish
    </div>
</span>
<span id="failed1" style="display: none;">
	<div style="background:#24cd77;color:#fff;padding:10px;border-radius:5px;margin-bottom:10px;" class="alert alert-danger" role="alert">
    <strong>Success </strong> Publish
    </div>
</span>
</div>

<input autocomplete="off" type="text" name="package_name" id="hide-packid" style="display: none">

<input autocomplete="off" type="text" name="email" id="hide-email" style="display: none">

<input autocomplete="off" type="text" name="rating" id="hide-rating" style="display: none">

<input autocomplete="off" type="text" name="downloads" id="hide-down" style="display: none">

<input autocomplete="off" type="text" name="website" id="hide-website" style="display: none">

<input autocomplete="off" type="text" name="dev_url" id="hide-dev-url" style="display: none">

<input autocomplete="off" type="text" name="icon" id="hide-icon-data" style="display: none">

<input autocomplete="off" type="text" name="date_release" id="hide-release" style="display: none">

</div>
</div>
</form>
</div>