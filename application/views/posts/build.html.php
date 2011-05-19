<h2>Create New Post</h2>


<?= form_open('posts/create') ?>

	<div>
		<label>Title</label>
		<input type="text" name="title" value="" />
	</div>

	<div>	
		<label>Body</label>
		<textarea name="body"></textarea>
	</div>
	
	<div>	
		<button type="submit">Create</button>
	</div>		

<?= form_close() ?>

<br /><br />

<p>
	<a href="/posts">Cancel</a>
</p>