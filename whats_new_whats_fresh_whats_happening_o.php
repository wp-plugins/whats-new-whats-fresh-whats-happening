<?php
if (!function_exists('sentenceSnip')) {
  function sentenceSnip($fullPost,$wordCap=10)
  {
    $strippedPost = strip_tags($fullPost);
  	$pieces = split("\. ?", $strippedPost);
    $piecesWord = explode(' ',$pieces[0]); // explode words in first sentence
  	$wordsInSentence = count($piecesWord);
    if ($wordsInSentence < 5 or $wordsInSentence > $wordCap) // short sentence so take first X words instead OR long sentence so cap 
    { 
      $piecesWord = explode(' ',$strippedPost); 
      $piecesWord = array_slice($piecesWord, 0, $wordCap); 
      $postSentence = implode(' ',$piecesWord).'...';  
    }  
    else { $postSentence = trim($pieces[0]).'.'; } 
    return($postSentence);
  }
}

	global $wpdb;
	global $whatsNewFreshHappeningHTML;	

  $numPosts = get_option('wnwfwh_numberOfPosts');
  $numComments = get_option('wnwfwh_numberOfComments');
  $orderBy = get_option('wnwfwh_orderBy');
  $showSentence = get_option('wnwfwh_showSentence');
  $showXWords = get_option('wnwfwh_showSentenceXwords');
  $showAuthor = get_option('wnwfwh_showAuthor');
	$showDate = get_option('wnwfwh_showDate');
	$postsHeading = get_option('wnwfwh_postsHeading');
  $commentsHeading = get_option('wnwfwh_commentsHeading');
  $excludeCategories = get_option('wnwfwh_excludeCategories');
	
  $divStyle = get_option('wnwfwh_divStyle');
  $h5Style = get_option('wnwfwh_h5Style');
  $pStyle = get_option('wnwfwh_pStyle');
  $aStyle = get_option('wnwfwh_aStyle');
  $ulStyle = get_option('wnwfwh_ulStyle');
  $liStyle = get_option('wnwfwh_liStyle');

  $writeToFile = get_option('wnwfwh_writeToFile');
  
	$writePost1 = false; // set true to write to file
	
  $whatsNewFreshHappeningHTML = $before_widget.$before_title;
  $whatsNewFreshHappeningHTML = '<div id="whatsnewwhatsfreshwhatshappening" style="'.$divStyle.'">'.Chr(10).$after_title;

 	/* POSTS */
	$version = explode(".", get_bloginfo('version'));
	if ( $version[0] > 2 or ($version[0] == 2 and $version[1] >= 3) ) // version greater than 2.3
	{
	 if (strlen($excludeCategories) > 0) {$excludeCategories = ' AND t2.term_id NOT IN ('.$excludeCategories.')  AND t2.taxonomy="category" ';}
	 $whatsNewFreshHappenings = $wpdb->get_results("SELECT DISTINCT t1.ID, t1.post_title, t1.post_date, t1.post_content, t3.display_name FROM $wpdb->posts t1, $wpdb->term_taxonomy t2, $wpdb->term_relationships t4, $wpdb->users t3 WHERE t1.post_status = 'publish' AND t1.ID=t4.object_id AND t4.term_taxonomy_id = t2.term_taxonomy_id AND t1.post_author = t3.ID ".$excludeCategories." ORDER BY ".$orderBy." LIMIT ".$numPosts);
	}
	else // pre 2.3
	{
   if (strlen($excludeCategories) > 0) {$excludeCategories = ' AND t2.category_id NOT IN ('.$excludeCategories.') ';}
	 $whatsNewFreshHappenings = $wpdb->get_results("SELECT DISTINCT t1.ID, t1.post_title, t1.post_date, t1.post_content, t3.display_name FROM $wpdb->posts t1, $wpdb->post2cat t2, $wpdb->users t3 WHERE t1.ID=t2.post_id AND t1.post_status = 'publish' AND t1.post_author = t3.ID ".$excludeCategories." ORDER BY ".$orderBy." LIMIT ".$numPosts);
	}

  if (count($whatsNewFreshHappenings) > 0) 
  {
    $whatsNewFreshHappeningHTML .= '<h5 style="'.$h5Style.'">'.$postsHeading.'</h5>'.Chr(10);
    foreach ($whatsNewFreshHappenings as $whatsNewFreshHappening) {
    	$postSentence = '';
      if (substr(strtolower($showSentence),0,1) == 'y' or substr(strtolower($showSentence),0,1) == 'p') {
					$postSentence = sentenceSnip($whatsNewFreshHappening->post_content,$showXWords);
    	}
			$postExtraDetail = false;
			$postHTML = '<p style="'.$pStyle.'"><a style="'.$aStyle.'" href="'.get_permalink($whatsNewFreshHappening->ID).'">'.$whatsNewFreshHappening->post_title.'</a>'; 
			if (substr(strtolower($showAuthor),0,1) == 'y' or substr(strtolower($showAuthor),0,1) == 'p') { $postHTML .= ' by '.$whatsNewFreshHappening->display_name; $postExtraDetail = true; } 
			if (substr(strtolower($showDate),0,1) == 'y' or substr(strtolower($showDate),0,1) == 'p') { $postHTML .= ' on '.date('F jS, Y',strtotime($whatsNewFreshHappening->post_date)); $postExtraDetail = true; } 
			if ($postExtraDetail) { $postSentence = '<br />'.$postSentence; } 
			$postHTML .= $postSentence.'</p>'.Chr(10);
			 
			$whatsNewFreshHappeningHTML .= $postHTML; 
			//optionally write out the first post to a file - a further method for embedding posts in non-WP pages
      if ($writePost1)
			{ 
  			$writePost1 = false;
  			$theFile = "whatsNewFreshHappeningPost1.HTML";
        $fh = fopen($theFile, 'w') or die("can't open file");
        fwrite($fh, '<div id="whatsnewwhatsfreshwhatshappening" style="'.$divStyle.'">'.$postHTML.'</div>');
        fclose($fh);
			}
    }
  }
	
 	/* COMMENTS */
  $orderBy = str_replace('post_date','comment_date',$orderBy);
  $whatsNewFreshHappenings = $wpdb->get_results("SELECT t1.comment_ID, t1.comment_post_ID, t1.comment_date, t1.comment_content, t1.comment_author, t2.post_title FROM $wpdb->comments t1, $wpdb->posts t2 WHERE t1.comment_post_ID = t2.ID AND t1.comment_approved = '1' ORDER BY ".$orderBy." LIMIT ".$numComments);
  if (count($whatsNewFreshHappenings) > 0) 
  {
    $whatsNewFreshHappeningHTML .= '<h5 style="'.$h5Style.'">'.$commentsHeading.'</h5>'.Chr(10);
    foreach ($whatsNewFreshHappenings as $whatsNewFreshHappening) {    
			$commentSentence = '';
      if (substr(strtolower($showSentence),0,1) == 'y' or substr(strtolower($showSentence),0,1) == 'c') {
					$commentSentence = sentenceSnip($whatsNewFreshHappening->comment_content,$showXWords);
    	}
			$commentExtraDetail = false;
    	$commentHTML = '<p style="'.$pStyle.'"><a style="'.$aStyle.'" href="'.get_permalink($whatsNewFreshHappening->comment_post_ID).'">On '.$whatsNewFreshHappening->post_title.'</a>';
			if (substr(strtolower($showAuthor),0,1) == 'y' or substr(strtolower($showAuthor),0,1) == 'c') { $commentHTML .= ' by '.$whatsNewFreshHappening->comment_author; $commentExtraDetail = true; }
			if (substr(strtolower($showDate),0,1) == 'y' or substr(strtolower($showDate),0,1) == 'c') { $commentHTML .= ' on '.date('F jS, Y',strtotime($whatsNewFreshHappening->comment_date)); $commentExtraDetail = true; }
			if ($commentExtraDetail) { $commentSentence = '<br />'.$commentSentence; } 
			$commentHTML .= $commentSentence.'</p>'.Chr(10);
			
			$whatsNewFreshHappeningHTML .= $commentHTML;
  	}
  }
  $whatsNewFreshHappeningHTML .= '</div>'.$after_widget;
  
  _e($whatsNewFreshHappeningHTML);	
	
	if (substr(strtolower($writeToFile),0,1) == 'y')
	{
    $theFile = "whatsNewFreshHappening.HTML";
    $fh = fopen($theFile, 'w') or die("can't open file");
    fwrite($fh, $whatsNewFreshHappeningHTML);
    fclose($fh);
	}
?>
