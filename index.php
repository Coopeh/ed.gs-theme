<?php

get_header();

?>

<div class="entry-meta">
	<?php echo date('M d, Y'); ?> &rsaquo; <div id="twitter">
<?php

function parseTweet($text) {
$pattern_url = '~(?>[a-z+]{2,}://|www\.)(?:[a-z0-9]+(?:\.[a-z0-9]+)?@)?(?:(?:[a-z](?:[a-z0-9]|(?<!-)-)*[a-z0-9])(?:\.[a-z](?:[a-z0-9]|(?<!-)-)*[a-z0-9])+|(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))(?:/[^\\/:?*"|\n]*[a-z0-9])*/?(?:\?[a-z0-9_.%]+(?:=[a-z0-9_.%:/+-]*)?(?:&[a-z0-9_.%]+(?:=[a-z0-9_.%:/+-]*)?)*)?(?:#[a-z0-9_%.]+)?~i';
'@([A-Za-z0-9_]+)';
$tweet = preg_replace('/(^|\s)#(\w+)/', '\1#<a
href="http://search.twitter.com/search?q=%23\2" rel="nofollow">\2</a>', $text);
$tweet = preg_replace('/(^|\s)@(\w+)/', '\1@<a
href="http://www.twitter.com/\2" rel="nofollow">\2</a>', $tweet);
$tweet = preg_replace("#(^|[\n ])(([\w]+?://[\w\#$%&~.\-;:=,?@\[\]+]*)(/[\w\#$%&~/.\-;:=,?@\[\]+]*)?)#is", "\\1<a
href=\"\\2\" title=\"\\2\" rel=\"nofollow\">[link]</a>", $tweet);
return $tweet;
}

$username='Coopeh'; // set user name
$format='json'; // set format
$tweet=json_decode(file_get_contents("http://api.twitter.com/1/statuses/user_timeline/{$username}.{$format}")); // get tweets and decode them into a variable

$theTweet = parseTweet($tweet[0]->text);

echo '"' . $theTweet . '"';

?></div>
</div><!-- .entry-meta -->

<?php

get_template_part( 'loop', 'index' );

get_footer();

?>
