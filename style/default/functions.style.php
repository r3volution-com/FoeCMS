<?php 
if (!function_exists("putNews")) {
	function putNews() { 
		$res = getNewsFrontPage();
		while ($row = mysql_fetch_array($res)) {
			$user = fetchUser($row["author_id"]);
			echo "<b>".$row["text"]."</b> - By ".$user["username"]." - At ".$row["date"]." // ";
		}
	}
}
if (!function_exists("getItemName")) {
	function getItemName($row, $no_link=false) {
		global $ROOT_HTML;
		if(checkLogin(true) && !$no_link) { 
			if (getConfig("seo_url")) return '<a href="'.$ROOT_HTML.'item/'.$row["id"].'">'.$row['name'].'</a>';
			else return '<a href="'.$ROOT_HTML.'viewitem.php?i='.$row["id"].'">'.$row['name'].'</a>';
		} else if ($no_link) return $row['name'];
		else return $row['name'];
	}
}
if (!function_exists("getItemImage")) {
	function getItemImage($row, $download = 0) {
		global $ROOT_HTML;
		global $STYLE_IMAGE;
		global $LANG;
		if ($row["url"]) {
			if(!$download) {
				if(checkLogin(true)) {
					if (!getConfig("seo_url")) return '<a href="'.$ROOT_HTML.'viewitem.php?i='.$row["id"].'"><img id="itemimg" src="'.geturl(getcat($row['category_id']), $row['url'],"image", 1).'" /></a>';
					else return '<a href="'.$ROOT_HTML.'item/'.$row["id"].'"><img id="itemimg" src="'.geturl(getcat($row['category_id']), $row['url'],"image", 1).'" /></a>';
				}
				else return '<img id="itemimg" src="'.$STYLE_IMAGE.$LANG["lang"].'/registrate.png"/>'; 
			} else {
				if(canDownload()) return '<a href="'.$ROOT_HTML.'download.php?f='.$row["id"].'"><img style="z-index:1" src="'.$STYLE_IMAGE.$LANG["lang"].'/descarga.png" /><img style="position: relative; z-index:-1; top: -88px; margin-bottom: -88px;" id="itemimg" src="'.geturl(getcat($row['category_id']), $row['url'], "image", 1).'" border="0"/></a>';
				else return '<img id="itemimg" src="'.$STYLE_IMAGE.$lang["lang"].'/registrate.png" border="0"/>';
			}
		}
	}
}
if (!function_exists("putLangFlags")) {
	function putLangFlags($res, $pre, $pos, $pre2="", $pos2="") {
		global $ROOT_HTML;
		while ($row = mysql_fetch_array($res)) {
			if ($row["id"] < 3) echo $pre.'<a href="'.$ROOT_HTML.'index.php?i='.$row["id"].'"><img width="20px" height="20px" border="0" src="'.$ROOT_HTML.'lang/'.$row["lang"].'/'.$row["lang"].'.png" /></a>'.$pos;
			else if ($row["id"] == 3) echo $pre2.'<ul><li><a href="'.$ROOT_HTML.'index.php?i='.$row["id"].'"><img width="20px" height="20px" border="0" src="'.$ROOT_HTML.'lang/'.$row["lang"].'/'.$row["lang"].'.png" /></a></li>';
			else if ($row["id"] > 3) echo '<li><a href="'.$ROOT_HTML.'index.php?i='.$row["id"].'"><img width="20px" height="20px" border="0" src="'.$ROOT_HTML.'lang/'.$row["lang"].'/'.$row["lang"].'.png" /></a></li>';
		}
		echo "</ul>".$pos2;
	}
}
if (!function_exists("putStyleList")) {
	function putStyleList() {
		global $MYSQL_PREFIX;
		global $user_row;
		$res = getStyles();
		while ($row = mysql_fetch_array($res)) {
			if ($user_row["style_id"] != $row["id"]) echo '<option value="'.$row["id"].'">'.$row["name"].'</option>';
			else echo '<option selected="selected" value="'.$row["id"].'">'.$row["name"].'</option>';
		}
	}
}
if (!function_exists("putFrontpageList")) {
	function putFrontpageList($cat) {
		global $MYSQL_PREFIX;
		global $ROOT_HTML;
		$id = 0;
		$res = getFrontPage($cat);
		while ($row = mysql_fetch_array($res)) {
			if ($id == 2) echo "<br>";
			else if ($id > 3) break;
			$id = $id + 1;
			if ($row["url"]) {
				if (getConfig("seo_url")) echo '<a href="'.$ROOT_HTML.'item/'.$row["id"].'"><img src="'.geturl(getcat($row['category_id']), $row['url'],"image", 1).'" width="320px" height="176px" border="0"/></a>';
				else echo '<a href="'.$ROOT_HTML.'viewitem.php?i='.$row["id"].'"><img src="'.geturl(getcat($row['category_id']), $row['url'],"image", 1).'" width="320px" height="176px" border="0"/></a>';
			} else {
				if (!getConfig("seo_url")) echo '<div style="display: inline-block; width:320px; margin-top:146px; text-align:center; font-size: 30px;"><a href="'.$ROOT_HTML.'viewitem.php?i='.$row["id"].'">'.$row["name"].'</a></div>';
				else echo '<div style="display: inline-block; width:320px; margin-top:146px; text-align:center; font-size: 30px;"><a href="'.$ROOT_HTML.'item/'.$row["id"].'">'.$row["name"].'</a></div>';
			}
		}
	}
}
if (!function_exists("getParentCategoryList")) {
	function getParentCategoryList($cat) {
		global $ROOT_HTML;
		$category_parent_list = array();
		for ($i = 0; $row = getCategoryBy($cat); $i++) {
			$cat = $row["parent_category_id"];
			if (!getConfig("seo_url")) $category_parent_list[$i] = '<a href="'.$ROOT_HTML.'store.php?c='.$row["category_id"].'">'.$row["name"].'</a>';
			else $category_parent_list[$i] = '<a href="'.$ROOT_HTML.'/'.$row["category_id"].'">'.$row["name"].'</a>';
			if ($i != 0) $category_parent_list[$i] .= ' &gt '; 
		}
		$category_parent_list[$i+1] = '<a href="'.$ROOT_HTML.'store.php">'._l("cms_index").'</a> &gt ';
		return array_reverse($category_parent_list);
	}
}

if (!function_exists("putSearchUserList")) {
	function putSearchUserList($u_res) {
		global $ROOT_HTML;
		global $STYLE_IMAGE;
		while ($listuser_row = mysql_fetch_array($u_res)) {
			if ($listuser_row["avatar"]) $avatar = $listuser_row['avatar']; 
			else $avatar = $STYLE_IMAGE."default.png";
			echo '<table id="bordertable" border="0" cellpadding="0" cellspacing="0" width="100%"> 
				<tr>
					<td width="160px"><img style="border-radius: 15px; -moz-border-radius: 15px;" src="'.$avatar.'" width="160px" height="88px" border="0"/></a></th>
					<td><b>'._l("user_name").': </b><a href="'.$ROOT_HTML.'ucp/ucpviewprofile.php?u='.$listuser_row["id"].'">'.$listuser_row['username'].'</a></td>
				</tr>
			</table>';
		} 
	}
}
if (!function_exists("putSearchItemList")) {
	function putSearchItemList($i_res) {
		while ($row = mysql_fetch_array($i_res)) { 
			echo '<table id="bordertable" border="0" cellpadding="0" cellspacing="0" width="100%">
				<tr>
					<th width="160px">'.getItemImage($row).'</th>
					<td><b>'._l("item_name").': '.getItemName($row).'</b></td>
					<td width="150px" rowspan="2"><b>'._l("item_timesdownloaded").':</b> '.$row["times_downloaded"].'<br/><br/><b>'._l("comment_number").':</b> '.getNumComments($row["id"]).'</td>
				</tr>
			</table>';
		}
	}
}
if (!function_exists("putCategoryList")) {
	function putCategoryList() {
		global $ROOT_HTML;
		$res = getCategoryList(); 
		while ($row = mysql_fetch_array($res)) {
			if (!getConfig("seo_url")) echo "<li><a href='".$ROOT_HTML."store.php?c=".$row["category_id"]."'>".$row["name"]."</a></li>";
			else echo "<li><a href='".$ROOT_HTML."store/".$row["category_id"]."'>".$row["name"]."</a></li>";
		}
	}
}
if (!function_exists("putParentCategoryList")) {
	function putParentCategoryList($cat) {
		$array = getParentCategoryList($cat); 
		for ($i = 0; isset($array[$i]); $i++) echo $array[$i];
	}
}
if (!function_exists("putCategoryList")) {
	function putCategoryList($cat) {
		global $ROOT_HTML;
		$res = getCategoryList($cat); 
		$row = getCategoryBy($cat);
		echo "<li id='current'>".$row["name"]."</li>";
		while ($row = mysql_fetch_array($res)) {
			if (!getConfig("seo_url")) echo "<li><a href='".$ROOT_HTML."store.php?c=".$row["category_id"]."'>".$row["name"]."</a></li>";
			else echo "<li><a href='".$ROOT_HTML."store/".$row["category_id"]."'>".$row["name"]."</a></li>";
		}
	}
}

if (!function_exists("putItemList")) {
	function putItemList($cat) {
		$res = getItems($cat);
		$result = post_pagination($res, getConfig("item_per_page"));
		if (!$result["n_items"]) echo _l("item_notfound");
		foreach ($result["fetch_array"] as $row) {
			if ($row["name"]) echo '<table id="bordertable" border="0" width="100%">
				<tr>
					<th width="160px" rowspan="2">'.getItemImage($row).'</th>
					<td><b>'._l("item_name").': '.getItemName($row).'</b></td>
					<td width="150px" rowspan="2"><b>'._l("item_timesdownloaded").':</b> '.$row["times_downloaded"].'<br/><br/><b>'._l("comment_number").':</b> '.getNumComments($row["id"]).'</td>
				</tr>
				<tr>
					<td>'."<b>"._l("item_description").":</b> ".$row['description'].'</td>
				</tr>
			</table>';
		}
		return $result;
	}
}
if (!function_exists("putCommentList")) {
	function putCommentList($item) {
		global $USER_ID;
		global $ROOT_HTML;
		$res = getCommentsData($item);  
		$result = post_pagination($res, getConfig("item_per_page"));
		if (!$result["n_items"]) echo _l("comment_nocomment");
		else { 
			foreach ($result["fetch_array"] as $row) {
				if ($row["user_id"] != 0) {
					$row2 = fetchUser($row["user_id"]);
					if ($row2["id"] == $USER_ID) $buttons = '<a id="littlebutton" href="'.$ROOT_HTML.'comment.php?ec='.$row["id"].'">'. _l("item_edititem").'</a><a id="littlebutton" href="comment.php?rc='.$row["id"].'">'._l("item_removeitem").'</a>';
					else $buttons = "";
					if (!getConfig("seo_url")) $info = 'By: <a href="'.$ROOT_HTML.'ucp/ucpviewprofile.php?i='.$row2["id"].'">'.$row2["username"].'</a>, at: '.$row["date"];
					else  $info = 'By: <a href="'.$ROOT_HTML.'profile/'.$row2["id"].'">'.$row2["username"].'</a>, at: '.$row["date"];
					$firm = $row2["firm"];
				} else {
					$info = 'By: Guest_'.time().', at: '.$row["date"];
				}
				if ($row["comment"]) echo '<table border="0" width="100%" id="bordertable"> 
					<tr>
						<td>'.$info.'
							<div align="right" style="float:right">'.$buttons.'</div>
						</td>
					</tr>
					<tr>
						<td>'.$row["comment"].'</td>
					</tr>
					<tr>
						<td><hr/>'.$firm.'</td>
					</tr>
				</table>';
			} 
		}
		return $result;
	}
}

if (!function_exists("putInboxList")) {
	function putInboxList($resIn) {
		global $ROOT_HTML;
		while ($row = mysql_fetch_array($resIn["query_result"])) {
			$raw = fetchUser($row["idsend"]);
			if ($row["read"] == 1) $readed = _l("mp_read");  
			else $readed = _l("mp_notread"); 
			echo '<tr>
				<td><a href="'.$ROOT_HTML.'ucp/ucpviewmp.php?mp='.$row['id'].'&user='.$row["idsend"].'&type=1">'.$row['topic'].'</a></td>
				<td>'.$raw["username"].'</td>
				<td>'.$readed.'</td>
				<td>'.$row["date"].'</td>
			</tr>';
		}
	}
}

if (!function_exists("putOutboxList")) {
	function putOutboxList($resOut) {
		global $ROOT_HTML;
		while ($row = mysql_fetch_array($resOut["query_result"])) { 
			$raw = fetchUser($row["idreceive"]);
			echo '<tr>
				<td><a href="'.$ROOT_HTML.'ucp/ucpviewmp.php?mp='.$row['id'].'&user='.$row["idreceive"].'&type=2">'.$row['topic'].'</a></td>
				<td>'.$raw["username"].'</td>
				<td>'.$row["date"].'</td>
			</tr>';
		}
	}
}

if (!function_exists("putMemberList")) {
	function putMemberList($res) {
	global $ROOT_HTML;
		while($listuser_row = mysql_fetch_array($res["query_result"])){
			if (isset($_GET["t"])) {
				?><a href="javascript:GetRowValue('<?php echo $listuser_row["username"]; ?>')"><?php echo $listuser_row["username"]; ?></a>,<?php 
			} else echo '<a href="'.$ROOT_HTML.'ucp/ucpviewprofile.php?u='.$listuser_row["id"].'">'.$listuser_row["username"].'</a>,';
		}
	}
}
if (!function_exists("putUserItemList")) {
	function putUserItemList($res_item) {
		global $ROOT_HTML;
		while ($i_row = mysql_fetch_array($res_item["query_result"])) {
			if (!getConfig("seo_url")) $url = '<a href="'.$ROOT_HTML.'viewitem.php?i='.$i_row["id"].'">'.$i_row["name"].'</a>';
			else $url = '<a href="'.$ROOT_HTML.'item/'.$i_row["id"].'">'.$i_row["name"].'</a>';
			echo '<table id="bordertable" border="0" width="100%">
				<tr>
					<td><b>'. _l("item_name").':</b> '.$url.'</td>
					<td width="150px" rowspan="2"><b>'._l("item_timesdownloaded").":</b> ".$i_row["times_downloaded"].'</td>
				</tr>
				<tr>
					<td><b>'._l("item_description").":</b> ".$i_row['description'].'</td>
				</tr>
			</table>';
		}
	}
}
if (!function_exists("putUserCommentList")) {
	function putUserCommentList($res_comment) {
		global $ROOT_HTML;
		while ($c_row = mysql_fetch_array($res_comment["query_result"])) { 
			$cuser_row = fetchUser($c_row["user_id"]);
			if (!getConfig("seo_url")) $url1 = '<a href="'.$ROOT_HTML.'ucp/ucpviewprofile.php?u='.$cuser_row["id"].'">'.$cuser_row["username"].'</a>';
			else $url1 = '<a href="'.$ROOT_HTML.'profile/'.$cuser_row["id"].'">'.$cuser_row["username"].'</a>';
			if (!getConfig("seo_url")) $url2 = '<a href="'.$ROOT_HTML.'viewitem.php?i='.$c_row["item_id"].'"><-</a>';
			else $url2 = '<a href="'.$ROOT_HTML.'viewitem.php?i='.$c_row["item_id"].'"><-</a>';
			echo '<table id="bordertable" border="0" width="100%"> 
				<tr>
					<td> '.$url1.' - '.$c_row["date"].' - '.$url2.'</td>
				</tr>
				<tr>
					<td>'.$c_row["comment"].'</td>
				</tr>
			</table>';
		}
	}
}
if (!function_exists("putCategorySelectList")) {
	function putCategorySelectList() {
		$res = getCategoryList(); 
		while ($row = mysql_fetch_array($res)) {
			if (isset($item_row["category_id"]) && $item_row["category_id"] == $row["category_id"]) $selected='selected="selected"';
			else $selected = "";
			if (!$row["parent_category_id"]) echo '<option '.$selected.' value="'.$row["category_id"].'">'.$row["name"].'</option>';
			else echo '<option '.$selected.' value="'.$row["category_id"].'">->'.$row["name"].'</option>';
		}
	}
}
if (!function_exists("putInvitationList")) {
	function putInvitationList($resInv) {
		while ($row = mysql_fetch_array($resInv["query_result"])) {
			echo "<li>".$row["to_email"]."</li>";
		}
	}
}
?>