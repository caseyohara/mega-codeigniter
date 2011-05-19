<h2><?= $post->title ?></h2>

<p><?= $post->body ?></p>

<div id="comments">
	<h3>Comments</h3>
	<?php foreach ( $post->comments as $comment ) : ?>
		<p><?= $comment->text ?></p>
	<?php endforeach; ?>
	
	<h4>Add Comment</h4>
	<?= form_open('comments/create') ?>
		<input type="hidden" name="post_id" value="<?= $post->id ?>" />
		<input type="hidden" name="redirect" value="/posts/<?= $post->id ?>" />
		<textarea name="text"></textarea>
		<button type="submit">Save</button>
	<?= form_close() ?>
	
</div>

<br /><br />

<p>
	<a href="/posts">All Posts</a> | 
	<a href="/posts/edit/<?= $post->id ?>">Edit Post</a> | 
	<a href="/posts/delete/<?= $post->id ?>">Delete Posts</a>
</p>