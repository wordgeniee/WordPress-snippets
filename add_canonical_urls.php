<?php
/*
In multisite, if same pages, posts or products are available on all sites.Client owner wants to submit only main site url to search engines for ranking, then in this case we can use canonical urls for this. Following code can be used to add canonical tags on subsites in header.
*/
$blog_id = get_current_blog_id();
if ($blog_id != 1) {
		 
		$url =$_SERVER['REQUEST_URI'];
    
        $new_url = substr($url, 2);
        $home = get_home_url(1);
        $canonical_url = $home.$new_url;
		$ch = curl_init($canonical_url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_exec($ch);


		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
       if($retcode == 200)
       {
        echo "<link href='$canonical_url' rel='canonical' />";
		}
}


